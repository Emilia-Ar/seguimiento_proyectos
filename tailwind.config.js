/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          'school-blue': '#1E40AF',
          'school-green': '#10B981',
        },
      },
    },
    plugins: [],
  }