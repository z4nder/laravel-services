const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
  purge: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],

  theme: {
    screens: {
        'lt': '360px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
    },
    extend: {
      textColor: {
        'info': {
            'title':        "var(--info-title)",
            'txt':          "var(--info-txt)",
            'icon':         "var(--info-icon)",
        },
        'time': {
            'txt':          "var(--time-txt)",
        },
      },
      colors: {
        sys_primary: colors.indigo,
        sys_secondary: colors.violet,
        sys_success: colors.emerald,
        sys_error: colors.red,
        sys_alert: colors.amber,
        'info': {
            'bg':           "var(--info-bg)",
            'separator':    "var(--info-separator)",
        },
        'time': {
            'bg':           "var(--time-bg)"
        },

      },
      fontFamily: {
        sans: ['Nunito', ...defaultTheme.fontFamily.sans],
      },
    },
  },

  variants: {
    extend: {
      opacity: ['disabled'],
    },
  },

  plugins: [require('@tailwindcss/forms'), require("@tailwindcss/ui"), require('@tailwindcss/aspect-ratio')],
}
