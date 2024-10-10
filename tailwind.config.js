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
      },
      scale: {
        '102' : '1.02', 
      },
      width: {
        '98' : '400px'
      }
    },
  },
  plugins: [
    function ({ addUtilities }) {
      const newUtilities = {
        ".no-scrollbar::-webkit-scrollbar": {
          display: "none",
        },
        ".no-scrollbar": {
          "-ms-overflow-style": "none",
          "scrollbar-width": "none",
        },
      };

      addUtilities(newUtilities);
    }
  ],
}
