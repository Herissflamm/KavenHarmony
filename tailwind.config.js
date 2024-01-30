/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        blue: {
          50 : '#82b8d9',
          100 : '#1c3f7f',
        },
        red: {
          50 : '#974a59',
        },
        white: {
          50 : '#fcebe1',
        },
      }
    },
  },
  plugins: [],
}
