/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./index.html",
        "./src/**/*.{html,js}"
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                rachi: {
                    navy: {
                        950: '#071326',
                        900: '#0b1c3d',
                        800: '#0d224a',
                        700: '#132e60',
                        600: '#1b3f82'
                    },
                    gold: {
                        50: '#fbf8f0',
                        100: '#f5efdc',
                        200: '#ebdcb8',
                        300: '#dec28d',
                        400: '#d0a762',
                        500: '#c6a45a',
                        600: '#b8944a',
                        700: '#997539',
                        800: '#7c5e33',
                        900: '#674d2d'
                    },
                    blue: {
                        accent: '#4ea2ff',
                        hover: '#3a8ee6',
                        dark: '#0b4ea8',
                        light: '#e0efff'
                    },
                    tec: '#0ea5e9',      // Azul ciano para TEC
                    print: '#ec4899',    // Magenta/Cyan para PRINT
                    academy: '#10b981',  // Verde para ACADEMY
                    capital: '#c6a45a'   // Dourado para CAPITAL
                }
            },
            fontFamily: {
                sans: ['Montserrat', 'system-ui', 'sans-serif'],
                display: ['Montserrat', 'system-ui', 'sans-serif']
            },
            borderRadius: {
                rachi: '6px'
            },
            boxShadow: {
                'rachi-card': '0 14px 34px rgba(11, 26, 46, 0.08)',
                'rachi-glow': '0 0 25px rgba(78, 162, 255, 0.25)',
                'rachi-gold-glow': '0 0 25px rgba(198, 164, 90, 0.25)'
            }
        },
    },
    plugins: [
        // @tailwindcss/forms
    ],
}
