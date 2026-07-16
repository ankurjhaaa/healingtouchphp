<?php
require_once __DIR__ . '/config/db.php';

$seo_title = 'अपॉइंटमेंट बुक करें | Healing Touch Hospital';
$seo_description = 'Book your appointment online at Healing Touch Hospital. Select a doctor, choose a time slot, and confirm your booking instantly.';
$active_page = 'book-appointment';

// Fetch departments
$departments = [];
try {
    $stmt = $pdo->prepare("SELECT * FROM departments ORDER BY name ASC");
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {}

// Fetch doctors
$doctors = [];
try {
    $stmt = $pdo->prepare("
        SELECT d.*, u.name as user_name, dep.name as department_name 
        FROM doctors d 
        LEFT JOIN users u ON d.user_id = u.id 
        LEFT JOIN departments dep ON d.department_id = dep.id
    ");
    $stmt->execute();
    $doctors_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($doctors_raw as $doc) {
        $doc['user'] = ['name' => $doc['user_name']];
        $doc['department'] = ['name' => $doc['department_name']];
        
        // Handle available_days
        $days = [];
        if (!empty($doc['available_days'])) {
            $decoded = json_decode($doc['available_days'], true);
            if (is_array($decoded)) {
                $days = $decoded;
            } else {
                $days = array_map('trim', explode(',', trim($doc['available_days'], '"[]')));
            }
        }
        $doc['available_days'] = $days;
        
        // Handle qualification
        $quals = [];
        if (!empty($doc['qualification'])) {
            $decoded = json_decode($doc['qualification'], true);
            if (is_array($decoded)) {
                $quals = $decoded;
            } else {
                $quals = array_map('trim', explode(',', trim($doc['qualification'], '"[]')));
            }
        }
        $doc['qualification'] = $quals;
        
        $doctors[] = $doc;
    }
} catch (Exception $e) {}

$preselected_slug = $_GET['doctor'] ?? '';

include __DIR__ . '/includes/header.php';
?>

<!-- Include Alpine.js for interactive UI state without a build step -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div x-data="bookingApp()" class="public-page min-h-screen bg-gray-50 font-sans text-gray-900 antialiased overflow-x-hidden pb-32 sm:pb-24 lg:pb-0 flex flex-col">
    
    <div class="max-w-6xl mx-auto w-full px-2.5 sm:px-6 lg:px-8 py-2.5 sm:py-8 mt-16">
        <!-- Progress Header -->
        <div class="mb-2.5 sm:mb-4 md:mb-6 bg-gradient-to-r from-beige-600 to-beige-800 rounded-lg sm:rounded-xl py-2.5 md:py-4 px-3 md:px-6 text-white border border-beige-700">
            <div class="flex flex-wrap items-start justify-between gap-2">
                <div>
                    <h1 class="text-base sm:text-lg md:text-xl font-bold">ऑनलाइन अपॉइंटमेंट बुकिंग</h1>
                    <p class="text-beige-100 text-[11px] sm:text-xs opacity-90 mt-0.5" x-text="headerText()"></p>
                </div>
            </div>

            <div x-show="!showBookingNotes" class="mt-3 relative hidden sm:block">
                <div class="absolute top-3 left-0 right-0 h-0.5 bg-beige-300 rounded-full z-0 mx-6 md:mx-12"></div>
                <div class="absolute top-3 left-0 h-0.5 bg-white rounded-full z-10 transition-all duration-500 mx-6 md:mx-12" :style="`width: ${Math.min(90, (step - 1) * 30)}%`"></div>
                <div class="relative z-20 flex items-center justify-between gap-2 md:gap-6">
                    <template x-for="s in [{id:1, label:'डॉक्टर'}, {id:2, label:'जानकारी'}, {id:3, label:'पुष्टि'}]" :key="s.id">
                        <div class="flex flex-1 flex-col items-center min-w-0">
                            <div :class="step >= s.id ? 'bg-white text-beige-700 border-2 border-white' : 'bg-beige-700 text-white border border-beige-300'" class="w-6 h-6 md:w-7 md:h-7 rounded-full flex items-center justify-center font-bold text-[10px] md:text-xs transition-all duration-300">
                                <span x-show="step <= s.id" x-text="s.id"></span>
                                <svg x-show="step > s.id" class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </div>
                            <span class="mt-1 text-[8px] md:text-[10px] font-medium text-white truncate text-center" x-text="s.label"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Booking Notes -->
        <div x-show="showBookingNotes" class="bg-white border border-gray-200 rounded-lg sm:rounded-xl p-3 sm:p-6 space-y-4">
            <div>
                <h2 class="text-base sm:text-xl font-bold text-gray-900">Healing Touch Hospital में अपॉइंटमेंट बुक करें</h2>
                <h3 class="mt-2 text-sm sm:text-base font-semibold text-beige-700">सूचना</h3>
            </div>
            <ul class="space-y-2 text-[13px] sm:text-sm text-gray-700 list-disc pl-5">
                <li>ऑनलाइन बुकिंग केवल अगले दिन के अपॉइंटमेंट के लिए है।</li>
                <li>यदि आप आज रात 12:00 बजे से पहले बुकिंग करते हैं, तो कल के लिए आपकी नियुक्ति की पुष्टि की जाएगी।</li>
                <li>कृपया बुकिंग के दौरान अपना फोन नंबर प्रदान करें। बुकिंग की पुष्टि उसी नंबर पर भेजी जाएगी।</li>
                <li>यदि आप किसी और का फोन नंबर प्रदान करते हैं, तो Healing Touch Hospital उस बुकिंग की गारंटी नहीं लेगा।</li>
                <li>बुकिंग से संबंधित किसी भी जानकारी के लिए अस्पताल के आधिकारिक नंबर या हेल्पडेस्क से संपर्क करें।</li>
            </ul>
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-1">
                <button @click="showBookingNotes = false" type="button" class="w-full sm:w-auto px-5 py-2.5 rounded-lg bg-beige-600 text-white font-semibold hover:bg-beige-700 justify-center">
                    आगे बढ़ें
                </button>
            </div>
        </div>

        <!-- Step 1: Doctor Selection -->
        <div x-show="!showBookingNotes && step === 1" class="space-y-2.5 sm:space-y-6">
            
            <div x-show="!isDoctorLocked()" class="bg-white p-3 sm:p-5 rounded-lg sm:rounded-xl border border-gray-200">
                <h2 class="text-sm sm:text-lg font-bold text-gray-800 mb-2.5 sm:mb-4 flex items-center gap-2">
                    <div class="p-1.5 sm:p-2 bg-beige-100 rounded-md sm:rounded-lg text-beige-600">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                    </div>
                    विभाग चुनें
                </h2>
                
                <div class="overflow-x-auto no-scrollbar pb-1">
                    <div class="grid grid-rows-2 sm:grid-rows-2 grid-flow-col auto-cols-max gap-1.5 sm:gap-2 w-max min-w-full">
                        <button @click="selectedDepartment = null" :class="selectedDepartment === null ? 'bg-beige-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800'" class="shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 rounded-md sm:rounded-full text-xs sm:text-sm font-medium transition-colors duration-200">सभी विभाग</button>
                        <template x-for="d in departments" :key="d.id">
                            <button @click="selectedDepartment = d.id" :class="selectedDepartment === d.id ? 'bg-beige-600 text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-800'" class="shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 rounded-md sm:rounded-full text-xs sm:text-sm font-medium transition-colors duration-200" x-text="d.name"></button>
                        </template>
                    </div>
                </div>
            </div>

            <div class="bg-white p-3 sm:p-5 rounded-lg sm:rounded-xl border border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-3 mb-3 sm:mb-6">
                    <h2 class="text-base sm:text-lg font-bold text-gray-800" x-text="doctorConfirmed && selectedDoctor ? 'चुना हुआ डॉक्टर' : 'डॉक्टर चुनें'"></h2>
                    <div class="text-[11px] sm:text-sm text-gray-500">बुकिंग सिर्फ कल के लिए उपलब्ध है।</div>
                </div>

                <!-- Selected Doctor Confirmed -->
                <div x-show="selectedDoctor && doctorConfirmed" class="border border-beige-200 rounded-lg overflow-hidden bg-beige-50">
                    <div class="flex items-center justify-between px-3 sm:px-4 py-2.5 sm:py-3 border-b border-beige-100 bg-white">
                        <h3 class="text-sm sm:text-base font-semibold text-gray-900">Selected Doctor</h3>
                        <button type="button" @click="resetDoctorSelection()" class="text-xs sm:text-sm text-beige-700 hover:text-beige-800 font-semibold">Change Doctor</button>
                    </div>
                    <div class="p-3 sm:p-5">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg overflow-hidden bg-white border border-beige-200 shrink-0">
                                <img :src="selectedDoctor?.image || '/assets/images/default.jpg'" class="w-full h-full object-cover" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-base sm:text-lg font-bold text-gray-900 truncate" x-text="'Dr. ' + (selectedDoctor?.user?.name || '')"></h3>
                                <p class="text-xs sm:text-sm font-medium text-beige-600 truncate" x-text="selectedDoctor?.department?.name"></p>
                                <div class="mt-1.5 flex flex-wrap items-center gap-2 text-xs">
                                    <span class="rounded-md border border-beige-200 bg-white px-2 py-1 font-bold text-beige-700" x-text="'Fee ₹' + (selectedDoctor?.fee || '')"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Doctor List -->
                <div x-show="!doctorConfirmed && filteredDoctors().length > 0" class="mt-3 sm:mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                    <template x-for="doc in filteredDoctors()" :key="doc.id">
                        <div @click="selectDoctor(doc.slug)" :class="data.doctor_slug === doc.slug ? 'ring-2 ring-beige-500 bg-beige-50 border-beige-300 shadow-sm' : 'bg-white hover:bg-gray-50 border-gray-200'" class="relative min-h-[128px] sm:min-h-[156px] w-full rounded-xl border text-left transition-all cursor-pointer overflow-hidden">
                            <div class="p-3 sm:p-4">
                                <div class="flex items-start gap-3 sm:gap-4">
                                    <img :src="doc.image || '/assets/images/default.jpg'" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg object-cover border border-gray-200 bg-gray-100 shrink-0" />
                                    <div class="min-w-0 flex-1 pr-8">
                                        <h3 class="text-base sm:text-lg font-bold text-gray-900 truncate" x-text="'Dr. ' + doc.user?.name"></h3>
                                        <p class="mt-0.5 text-[11px] sm:text-xs text-beige-600 font-bold uppercase tracking-wide truncate" x-text="doc.department?.name"></p>
                                        <div class="mt-2 flex flex-wrap items-center gap-1.5">
                                            <span :class="data.doctor_slug === doc.slug ? 'border-beige-200 bg-white text-beige-700' : 'border-gray-200 bg-gray-50 text-gray-700'" class="rounded-md border px-2 py-1 text-[11px] font-black" x-text="'Fee ₹' + doc.fee"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span x-show="data.doctor_slug === doc.slug" class="absolute right-3 top-3 flex h-6 w-6 items-center justify-center rounded-full bg-beige-600 text-white shadow-sm">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Slots Selection -->
            <div x-show="data.doctor_slug && doctorConfirmed" class="bg-white p-3 sm:p-5 rounded-lg sm:rounded-xl border border-gray-200">
                <div class="flex items-center justify-between mb-2.5 sm:mb-4">
                    <h2 class="text-sm sm:text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        तारीख चुनें
                    </h2>
                    <button type="button" @click="doctorConfirmed = false; data.time = ''; availableSlots = []; slotsMessage = '';" class="rounded-md border border-gray-200 bg-white px-2.5 py-1.5 text-xs font-bold text-gray-600 hover:text-beige-700">वापस</button>
                </div>

                <div x-show="slotsMessage" class="mb-3 sm:mb-4 p-3 sm:p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium" x-text="slotsMessage"></div>

                <div class="mb-3 sm:mb-6 border-b border-gray-200">
                    <button type="button" class="py-2 sm:py-3 px-3 sm:px-6 border-b-2 font-medium text-xs sm:text-sm focus:outline-none border-beige-600 text-beige-600">
                        कल <span class="text-xs block text-gray-500" x-text="formatShortDate(data.date)"></span>
                    </button>
                </div>

                <div class="bg-gray-50 rounded-lg sm:rounded-2xl border border-gray-100 p-3 sm:p-5">
                    <div class="flex items-center gap-2 mb-3 sm:mb-4">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-800">अपॉइंटमेंट का समय चुनें</h3>
                    </div>

                    <div x-show="loadingSlots" class="py-8 text-center">
                        <div class="animate-spin h-8 w-8 border-4 border-beige-500 border-t-transparent rounded-full mx-auto"></div>
                    </div>

                    <div x-show="!loadingSlots && availableSlots.length > 0" class="space-y-4 sm:space-y-5">
                        <template x-for="group in slotGroups()" :key="group.key">
                            <div x-show="group.slots.length > 0">
                                <div class="flex items-center gap-2 text-gray-600 font-semibold mb-2 sm:mb-3">
                                    <span class="text-xs sm:text-base" x-text="group.label"></span>
                                </div>
                                <div class="grid grid-cols-4 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-1.5 sm:gap-2.5">
                                    <template x-for="slot in group.slots" :key="slot.slot">
                                        <button 
                                            type="button" 
                                            :disabled="!slot.bookable" 
                                            @click="if(slot.bookable) data.time = slot.slot" 
                                            :class="data.time === slot.slot ? 'bg-beige-600 text-white border-beige-600' : getSlotMetaClass(slot.booked)" 
                                            class="py-2 sm:py-2.5 rounded-md sm:rounded-lg text-[11px] sm:text-sm font-semibold border transition-colors"
                                            x-text="slot.slot"
                                        ></button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="!loadingSlots && availableSlots.length === 0" class="py-8 sm:py-10 text-center rounded-lg sm:rounded-2xl border border-dashed border-red-200 bg-red-50">
                        <div class="text-sm sm:text-base text-red-500 font-semibold mb-1">इस डॉक्टर के लिए कल का समय उपलब्ध नहीं है।</div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 text-sm items-center mt-5">
                <button :disabled="isChoosingSlot() ? !data.time : !data.doctor_slug" @click="handleStepOneContinue()" class="w-full sm:w-auto px-6 py-3 bg-beige-600 text-white rounded-xl border border-beige-600 hover:bg-beige-700 disabled:bg-gray-300 disabled:text-gray-500 flex items-center justify-center font-semibold">
                    आगे बढ़ें
                </button>
            </div>
        </div>

        <!-- Step 2: Patient Info -->
        <div x-show="!showBookingNotes && step === 2" class="bg-white p-3 sm:p-6 md:p-8 rounded-lg sm:rounded-2xl border border-gray-200 mb-5">
            <div class="flex items-center justify-between mb-3 sm:mb-8 border-b border-gray-100 pb-3 sm:pb-5">
                <div>
                    <h2 class="text-base sm:text-xl font-bold text-gray-800">मरीज की जानकारी</h2>
                </div>
                <button @click="step = 1" class="text-beige-700 font-semibold text-xs sm:text-sm bg-beige-50 px-2.5 sm:px-4 py-1.5 sm:py-2 rounded-md hover:bg-beige-100">← वापस</button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 sm:gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">पूरा नाम</label>
                    <input type="text" x-model="data.name" class="w-full rounded-md border-gray-200 focus:border-beige-500 focus:ring-beige-500 py-2.5 px-3 bg-gray-50" placeholder="मरीज का पूरा नाम" />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">मोबाइल नंबर</label>
                    <input type="tel" x-model="data.phone" @input="data.phone = $event.target.value.replace(/\D/g, '').slice(0, 10)" class="w-full rounded-md border-gray-200 focus:border-beige-500 focus:ring-beige-500 py-2.5 px-3 bg-gray-50" placeholder="10 अंकों का मोबाइल नंबर" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">उम्र</label>
                        <input type="tel" x-model="data.age" @input="data.age = $event.target.value.replace(/\D/g, '').slice(0, 3)" class="w-full rounded-md border-gray-200 py-2.5 px-3 bg-gray-50" placeholder="उम्र" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">पिनकोड</label>
                        <input type="tel" x-model="data.pincode" @input="handlePincode($event)" class="w-full rounded-md border-gray-200 py-2.5 px-3 bg-gray-50 font-mono tracking-widest" placeholder="6 अंकों का पिनकोड" />
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">लिंग</label>
                    <div class="rounded-lg border border-gray-200 bg-gray-100 p-1 grid grid-cols-3 gap-1">
                        <button type="button" @click="data.gender = 'male'" :class="data.gender === 'male' ? 'bg-white text-beige-700 shadow-sm ring-1 ring-beige-200' : 'text-gray-500'" class="rounded-md px-2 py-2.5 text-xs font-black transition-colors">पुरुष</button>
                        <button type="button" @click="data.gender = 'female'" :class="data.gender === 'female' ? 'bg-white text-beige-700 shadow-sm ring-1 ring-beige-200' : 'text-gray-500'" class="rounded-md px-2 py-2.5 text-xs font-black transition-colors">महिला</button>
                        <button type="button" @click="data.gender = 'other'" :class="data.gender === 'other' ? 'bg-white text-beige-700 shadow-sm ring-1 ring-beige-200' : 'text-gray-500'" class="rounded-md px-2 py-2.5 text-xs font-black transition-colors">अन्य</button>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-2">पूरा पता</label>
                    <input type="text" x-model="data.address" class="w-full rounded-md border-gray-200 py-2.5 px-3 bg-gray-50" placeholder="घर / रोड / गाँव" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">शहर / लोकेशन</label>
                        <input type="text" x-model="data.city" class="w-full rounded-md border-gray-200 py-2.5 px-3 bg-gray-50" placeholder="शहर या स्थान" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">राज्य</label>
                        <input type="text" x-model="data.state" class="w-full rounded-md border-gray-200 py-2.5 px-3 bg-gray-50" placeholder="राज्य" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-8 gap-3">
                <button :disabled="!patientFormComplete()" @click="step = 3" class="w-full sm:w-auto bg-beige-600 hover:bg-beige-700 text-white px-8 py-3 rounded-xl disabled:bg-gray-300 disabled:cursor-not-allowed font-semibold">बुकिंग देखें</button>
            </div>
        </div>

        <!-- Step 3: Review -->
        <div x-show="!showBookingNotes && step === 3" class="bg-white rounded-lg sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-3 sm:p-6 md:p-8 border-b border-beige-50 bg-beige-50/30">
                <h2 class="text-base sm:text-xl font-bold text-gray-900 leading-tight">बुकिंग की पुष्टि</h2>
            </div>
            <div class="space-y-3 p-3 sm:space-y-6 sm:p-6 md:p-8">
                <div class="rounded-xl border border-gray-200 bg-white p-3 sm:p-5">
                    <div class="flex items-start gap-3">
                        <img :src="selectedDoctor?.image || '/assets/images/default.jpg'" class="h-14 w-14 rounded-lg border border-gray-200 object-cover" />
                        <div>
                            <p class="text-[10px] font-black uppercase text-gray-400">Doctor</p>
                            <p class="mt-1 text-base font-black text-gray-900" x-text="'Dr. ' + selectedDoctor?.user?.name"></p>
                            <p class="text-xs font-bold uppercase text-beige-600" x-text="selectedDoctor?.department?.name"></p>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <div class="rounded-lg border border-beige-100 bg-beige-50 p-3">
                            <p class="text-[10px] font-black text-beige-700">Date</p>
                            <p class="mt-1 text-xs font-bold text-gray-900" x-text="formatDisplayDate(data.date)"></p>
                        </div>
                        <div class="rounded-lg border border-beige-100 bg-beige-50 p-3">
                            <p class="text-[10px] font-black text-beige-700">Time</p>
                            <p class="mt-1 text-sm font-black text-gray-900" x-text="data.time"></p>
                        </div>
                    </div>
                </div>
                
                <div class="rounded-xl border border-gray-200 bg-white p-3 sm:p-5">
                    <div class="mb-3 flex items-center justify-between">
                        <h3 class="text-sm font-black text-gray-900">Patient Details</h3>
                        <button @click="step = 2" class="rounded-md bg-beige-50 px-2.5 py-1.5 text-xs font-bold text-beige-700">Edit</button>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5 sm:grid-cols-4">
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-2.5">
                            <p class="text-[10px] font-black text-gray-400">Name</p>
                            <p class="mt-1 text-sm font-bold text-gray-900" x-text="data.name"></p>
                        </div>
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-2.5">
                            <p class="text-[10px] font-black text-gray-400">Phone</p>
                            <p class="mt-1 text-sm font-bold text-gray-900" x-text="data.phone"></p>
                        </div>
                        <div class="rounded-lg border border-gray-100 bg-gray-50 p-2.5">
                            <p class="text-[10px] font-black text-gray-400">Age / Gender</p>
                            <p class="mt-1 text-sm font-bold text-gray-900" x-text="data.age + ' / ' + data.gender"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-6 md:p-8 bg-gray-50/50 flex justify-end gap-3">
                <button :disabled="isSubmitting" @click="submitBooking()" class="w-full sm:w-auto bg-beige-600 hover:bg-beige-700 disabled:opacity-60 text-white px-6 py-3 rounded-xl font-semibold" x-text="isSubmitting ? 'प्रतीक्षा करें...' : 'अपॉइंटमेंट पक्का करें'"></button>
            </div>
            
            <div x-show="submitError" class="px-4 pb-4 text-sm font-medium text-red-600" x-text="submitError"></div>
        </div>

        <!-- Step 4: Success -->
        <div x-show="!showBookingNotes && step === 4" class="bg-white p-4 sm:p-6 md:p-8 rounded-lg sm:rounded-2xl border border-gray-100 text-center max-w-xl mx-auto">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1.5">Registration Complete!</h2>
            <p class="text-xs sm:text-sm text-gray-500 mb-5 font-medium">Your appointment has been successfully scheduled.</p>
            <div class="bg-gray-50 border border-dashed border-beige-200 p-3 sm:p-5 rounded-lg max-w-sm mx-auto mb-4">
                <p class="text-[10px] text-beige-600 uppercase font-semibold">Your Appointment Number</p>
                <p class="text-2xl sm:text-4xl font-mono font-bold text-gray-900" x-text="appointmentId"></p>
            </div>
            <a href="/" class="bg-beige-600 hover:bg-beige-700 text-white px-5 py-3 rounded-lg font-semibold inline-block">Back to Home</a>
        </div>

    </div>
</div>

<script>
function bookingApp() {
    return {
        departments: <?php echo json_encode($departments); ?>,
        doctors: <?php echo json_encode($doctors); ?>,
        step: 1,
        showBookingNotes: true,
        selectedDepartment: null,
        availableSlots: [],
        loadingSlots: false,
        slotsMessage: '',
        appointmentId: null,
        submitError: '',
        isSubmitting: false,
        doctorConfirmed: <?php echo $preselected_slug ? 'true' : 'false'; ?>,
        
        data: {
            doctor_slug: '<?php echo htmlspecialchars($preselected_slug); ?>',
            date: new Date(Date.now() + 86400000).toISOString().split('T')[0],
            time: '',
            name: '',
            phone: '',
            gender: 'male',
            age: '',
            address: '',
            pincode: '',
            city: '',
            state: ''
        },

        get selectedDoctor() {
            return this.doctors.find(d => d.slug === this.data.doctor_slug) || null;
        },

        filteredDoctors() {
            const weekday = new Date(this.data.date).toLocaleDateString('en-US', { weekday: 'long' }).toLowerCase();
            return this.doctors.filter(d => {
                const isDeptMatch = this.selectedDepartment ? d.department_id === this.selectedDepartment : true;
                const availableDays = (d.available_days || []).map(day => String(day).toLowerCase());
                const isDayMatch = availableDays.length === 0 || availableDays.includes(weekday);
                return isDeptMatch && isDayMatch;
            });
        },

        isDoctorLocked() {
            return this.selectedDoctor && this.doctorConfirmed;
        },

        isChoosingSlot() {
            return this.step === 1 && this.doctorConfirmed;
        },

        resetDoctorSelection() {
            this.data.doctor_slug = '';
            this.data.time = '';
            this.doctorConfirmed = false;
            this.availableSlots = [];
            this.slotsMessage = '';
        },

        selectDoctor(slug) {
            this.data.doctor_slug = slug;
            this.data.time = '';
            this.doctorConfirmed = false;
        },

        handleStepOneContinue() {
            if (!this.data.doctor_slug) return;
            if (!this.doctorConfirmed) {
                this.doctorConfirmed = true;
                this.fetchSlots();
                return;
            }
            if (this.data.time) {
                this.step = 2;
            }
        },

        fetchSlots() {
            if (!this.data.doctor_slug || !this.data.date) return;
            
            this.loadingSlots = true;
            this.slotsMessage = '';
            
            axios.post('/api/appointment/slots.php', {
                doctor_slug: this.data.doctor_slug,
                date: this.data.date
            }).then(res => {
                this.availableSlots = res.data.slots || [];
                this.slotsMessage = res.data.message || '';
                this.loadingSlots = false;
            }).catch(error => {
                this.availableSlots = [];
                this.slotsMessage = error?.response?.data?.error || error?.response?.data?.message || 'No slots available.';
                this.loadingSlots = false;
            });
        },

        slotGroups() {
            const groups = {
                morning: { label: 'Morning', slots: [] },
                afternoon: { label: 'Afternoon', slots: [] },
                evening: { label: 'Evening', slots: [] }
            };
            this.availableSlots.forEach(slot => {
                const timePart = String(slot.slot || '').split(' ')[0] || '0:00';
                const meridiem = String(slot.slot || '').split(' ')[1] || 'AM';
                let hourPart = parseInt(timePart.split(':')[0]);
                let hour24 = hourPart % 12;
                if (meridiem.toUpperCase() === 'PM') hour24 += 12;

                if (hour24 < 12) groups.morning.slots.push(slot);
                else if (hour24 < 16) groups.afternoon.slots.push(slot);
                else groups.evening.slots.push(slot);
            });
            return [groups.morning, groups.afternoon, groups.evening];
        },

        getSlotMetaClass(booked) {
            const remaining = Math.max(0, 4 - booked);
            if (remaining >= 3) return 'bg-green-100 border-green-200 text-green-700 hover:bg-green-200';
            if (remaining === 2) return 'bg-yellow-100 border-yellow-200 text-yellow-700 hover:bg-yellow-200';
            if (remaining === 1) return 'bg-red-100 border-red-200 text-red-700 hover:bg-red-200';
            return 'bg-gray-100 border-gray-200 text-gray-400 cursor-not-allowed';
        },

        handlePincode(e) {
            const pin = e.target.value.replace(/\D/g, '').slice(0, 6);
            this.data.pincode = pin;
            if (pin.length === 6) {
                axios.get(`https://api.postalpincode.in/pincode/${pin}`).then(res => {
                    if (res.data[0].Status === 'Success') {
                        const po = res.data[0].PostOffice[0];
                        this.data.city = po.Block || po.Name;
                        this.data.state = po.State;
                    }
                });
            }
        },

        patientFormComplete() {
            return this.data.name.trim() !== '' &&
                   /^\d{10}$/.test(this.data.phone) &&
                   this.data.gender !== '' &&
                   parseInt(this.data.age) >= 1 && parseInt(this.data.age) <= 125 &&
                   this.data.address.trim() !== '' &&
                   /^\d{6}$/.test(this.data.pincode) &&
                   this.data.city.trim() !== '';
        },

        submitBooking() {
            if (this.isSubmitting) return;
            this.isSubmitting = true;
            this.submitError = '';

            axios.post('/api/appointment/book.php', this.data).then(res => {
                if (res.data.success) {
                    this.appointmentId = res.data.appointment.appointment_no;
                    this.step = 4;
                } else {
                    this.submitError = res.data.message || 'Booking failed.';
                }
            }).catch(error => {
                this.submitError = error?.response?.data?.message || 'Unable to book appointment right now.';
            }).finally(() => {
                this.isSubmitting = false;
            });
        },

        headerText() {
            if(this.showBookingNotes) return 'पहले नियम पढ़ें, फिर डॉक्टर चुनें';
            if(this.step === 1) return this.doctorConfirmed ? 'समय चुनें' : 'डॉक्टर चुनें';
            if(this.step === 2) return 'मरीज की जानकारी भरें';
            if(this.step === 3) return 'बुकिंग पक्का करें';
            return 'अपॉइंटमेंट बुक हो गया';
        },
        
        formatShortDate(d) {
            return new Date(d).toLocaleDateString('en-US', { day: 'numeric', month: 'short' });
        },
        
        formatDisplayDate(d) {
            return new Date(d).toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        }
    }
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
