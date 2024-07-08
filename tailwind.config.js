/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  darkMode: "class",
  theme: {
    extend: {},
  },
  // plugins: ['prettier-plugin-tailwindcss'],
  plugins: [
    "prettier-plugin-svelte",
    "prettier-plugin-organize-imports",
    "prettier-plugin-tailwindcss", // MUST come last
  ],
}

