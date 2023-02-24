/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
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
