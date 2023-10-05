/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php", "./includes/*.php", "./scripts/*.js"],
  theme: {
    colors: {
      'navy': '#053B50',
      'blue': '#176B87',
      'teal': '#64CCC5',
      'gray': '#EEEEEE',
    },
    backgroundImage: {
      'hero': "url('../images/bg_hero.png')",
    },
    fontFamily: {
      'nunito': ['Nunito Sans', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [],
}