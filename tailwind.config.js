/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./src/**/*.{html,js,php,twig}",
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
