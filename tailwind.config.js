import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#0B1F3A",
                "primary-dark": "#07162A",
                accent: "#F59E0B",
                "accent-light": "#FFF4D8",
                surface: "#FFFFFF",
                background: "#F5F7FA",
                ink: "#172033",
                muted: "#667085",
                border: "#D9E0EA",
                success: "#16A34A",
                danger: "#DC2626",
                warning: "#D97706",
            },
        },
    },

    plugins: [forms],
};
