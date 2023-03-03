/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{html,js,php,twig}",
    "./templates/**/*.{html,js,php,twig}"
  ],
  safelist: [
    {
      pattern: /col-span-[1-6]/,
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
