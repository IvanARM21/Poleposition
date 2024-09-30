/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{html,js,php}", 
    "!./node_modules/**/*"
  ],  
  theme: {
    extend: {
      fontSize: {
        '50px' : '50px'
      }
    },
  },
  plugins: [],
}

