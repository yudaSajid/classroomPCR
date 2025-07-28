import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./app/Filament/Student/**/*.php",
        "./app/filament/student/**/*.php",
        "./app/filament/**/*.php",
        "./resources/views/filament/student/**/*.blade.php",
    ],
    darkmode: 'class'
};
