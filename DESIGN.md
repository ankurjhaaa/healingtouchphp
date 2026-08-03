# Healing Touch PHP - App-Like Design Guidelines

## Core Principles

1. **Native App Experience**: 
   - The UI must look and feel like a modern iOS/Android application.
   - Minimalist, highly consistent padding, and tactile elements.

2. **Unified Backgrounds & Cards**:
   - **Page Body**: Use a uniform soft background (`bg-slate-50`) across the entire app.
   - **Content Cards**: All content MUST be placed inside pure white cards (`bg-white`).
   - **Card Styling**: Use `rounded-md` exclusively for corners. Do not use `rounded-2xl` or `rounded-xl`. Keep borders clean (e.g. `border border-gray-100`) and shadows subtle (`shadow-sm`).
   - **Gradients**: NO gradients are allowed (`bg-gradient-to-*`). Use clean, solid, flat colors only.

3. **Navigation Behavior**:
   - **Mobile Bottom Navigation**: Instead of a hamburger sidebar, mobile devices use a sticky Bottom Navigation Bar (`fixed bottom-0`) with icon tabs (Home, Services, Doctors, More).
   - **Top App Bar**: Clean `bg-white` header locked to the top, showing only the logo/title and critical actions (like a profile or call button).

4. **Spacing & Padding (Strict Rules)**:
   - **Containers**: Use a strict, unified padding on mobile (e.g., `p-4`).
   - **Gaps**: Use `gap-4` uniformly between cards. Eliminate arbitrary massive paddings (`pt-32`, `mt-16`) and instead rely on standard app top-app-bar spacing.
   
5. **Card Layouts & Sliders**:
   - **Banners**: Hero sections are rounded swipeable banners with aspect ratios like `16:9` or `21:9`.
   - **Horizontal Scrolling**: Use horizontal snapping (`snap-x snap-mandatory`) for Services and Doctors without wrap.
   - **Text Truncation**: Text inside cards must be restricted to a single line (`truncate`) where applicable to prevent broken layouts.

6. **Colors**:
   - **Primary**: Deep Teal (`text-teal-700`, `bg-teal-700`). Use flat colors, no gradients.
   - **Surface**: White (`bg-white`) on top of Slate-50 (`bg-slate-50`).
   - **Text**: `slate-900` for headings, `slate-500` for subtitles.

7. **Typography & UI Polish**:
   - **Buttons & Badges**: Exclusively use `rounded-md`. No `rounded-full` pills.
   - Clean, modern fonts with structured weights.
