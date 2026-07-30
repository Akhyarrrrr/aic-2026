/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          green:  '#0D5F3A',
          gold:   '#C7982C',
        },
        primary: {
          DEFAULT: '#0D5F3A',
          50:  '#E8F5EE',
          100: '#C5E6D3',
          200: '#9ED4B5',
          300: '#72C194',
          400: '#4DB37A',
          500: '#0D5F3A',
          600: '#0B5232',
          700: '#09442A',
          800: '#073722',
          900: '#052A1A',
          950: '#031D12',
        },
        accent: {
          DEFAULT: '#C7982C',
          50:  '#FDF8ED',
          100: '#F9EDCC',
          200: '#F3DC99',
          300: '#EBC866',
          400: '#DFB340',
          500: '#C7982C',
          600: '#A67D22',
          700: '#85641A',
          800: '#644B14',
          900: '#43320D',
          950: '#2E2209',
        },
        surface: {
          DEFAULT: '#FAFAF8',
          50:  '#FFFFFF',
          100: '#FAFAF8',
          200: '#F3F4F1',
          300: '#E8E9E5',
          400: '#DCDDD8',
          500: '#C5C6C1',
        },
        ink: {
          DEFAULT: '#1A1D1C',
          muted: '#5D615F',
          subtle: '#8B8E8C',
        },
      },
      fontFamily: {
        sans: ['Poppins', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-lg': ['3.5rem', { lineHeight: '1.1', letterSpacing: '-0.02em', fontWeight: '700' }],
        'display':    ['2.75rem', { lineHeight: '1.15', letterSpacing: '-0.015em', fontWeight: '700' }],
        'display-sm': ['2.25rem', { lineHeight: '1.2', letterSpacing: '-0.01em', fontWeight: '700' }],
        'heading-lg': ['1.75rem', { lineHeight: '1.3', fontWeight: '600' }],
        'heading':    ['1.375rem', { lineHeight: '1.35', fontWeight: '600' }],
        'heading-sm': ['1.125rem', { lineHeight: '1.4', fontWeight: '600' }],
        'body-lg':    ['1.125rem', { lineHeight: '1.6' }],
        'body':       ['1rem', { lineHeight: '1.6' }],
        'body-sm':    ['0.875rem', { lineHeight: '1.55' }],
        'caption':    ['0.75rem', { lineHeight: '1.5' }],
      },
      spacing: {
        '18': '4.5rem',
        '22': '5.5rem',
        '30': '7.5rem',
        '34': '8.5rem',
      },
      borderRadius: {
        '2xl': '1rem',
        '3xl': '1.5rem',
      },
      boxShadow: {
        'card': '0 1px 3px rgba(13, 95, 58, 0.06), 0 1px 2px rgba(13, 95, 58, 0.04)',
        'card-hover': '0 10px 25px rgba(13, 95, 58, 0.08), 0 4px 10px rgba(13, 95, 58, 0.04)',
        'nav': '0 1px 3px rgba(13, 95, 58, 0.04)',
      },
      transitionTimingFunction: {
        'out-expo': 'cubic-bezier(0.16, 1, 0.3, 1)',
      },
      keyframes: {
        'loader-fade-in': {
          '0%': { opacity: '0', transform: 'scale(0.85)' },
          '100%': { opacity: '1', transform: 'scale(1)' },
        },
        'loader-slide-up': {
          '0%': { transform: 'translateY(0)' },
          '100%': { transform: 'translateY(-100%)' },
        },
        'fade-in': {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        'slide-up': {
          '0%': { opacity: '0', transform: 'translateY(24px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        'slide-left': {
          '0%': { opacity: '0', transform: 'translateX(24px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        'slide-right': {
          '0%': { opacity: '0', transform: 'translateX(-24px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        'scale-in': {
          '0%': { opacity: '0', transform: 'scale(0.95)' },
          '100%': { opacity: '1', transform: 'scale(1)' },
        },
      },
      animation: {
        'loader-fade-in': 'loader-fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'loader-slide-up': 'loader-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'fade-in': 'fade-in 0.5s ease-out forwards',
        'slide-up': 'slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-left': 'slide-left 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-right': 'slide-right 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'scale-in': 'scale-in 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
      },
    },
  },
  plugins: [],
}
