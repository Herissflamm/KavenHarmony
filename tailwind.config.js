/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    fontFamily: {
      'serif': ['DM Serif Display'],
      'montserrat': ['Montserrat'],
    },
    extend: {
      width: {
        '128': '28%',
      },
      colors: {
        blue: {
          50 : '#82b8d9',
          100 : '#1c3f7f',
        },
        red: {
          50 : '#974a59',
        },
        black: {
          50 : '#04050d',
        },
        yellow:{
          400 : '#ffbf00',
        },
        purple:{
          400 : '#9300a0',
        },
      }
    },
  },
  plugins: [],
}
