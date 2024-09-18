/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  safelist: [
    'text-orange-700',
    'text-green-700',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

