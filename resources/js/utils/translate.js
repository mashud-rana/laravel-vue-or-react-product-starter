/**
 * Translation Helper for React Components
 *
 * This helper provides translation functionality similar to Laravel's __() and trans() helpers
 * It uses translations passed from Laravel blade to window.translations object
 */

/**
 * Get all translations from window object
 * @returns {Object} translations object
 */
const getTranslations = () => {
    return window.translations || {};
};

/**
 * Translate a given key with optional replacements
 * Similar to Laravel's __() helper
 *
 * @param {string} key - Translation key (can be nested with dot notation)
 * @param {Object} replacements - Object with replacement values (e.g., {name: 'John', count: 5})
 * @returns {string} Translated string or the key if translation not found
 *
 * @example
 * // Simple translation
 * __('welcome') // returns "Welcome"
 *
 * @example
 * // With replacements
 * __('Hello :name!', {name: 'John'}) // returns "Hello John!"
 */
export const __ = (key, replacements = {}) => {
    const translations = getTranslations();

    // Get translation value
    let translation = translations[key];

    // If translation not found, return the key itself
    if (!translation) {
        return key;
    }

    // Replace placeholders with actual values
    let result = translation;

    // Replace :placeholder format
    Object.keys(replacements).forEach(placeholder => {
        const regex = new RegExp(`:${placeholder}\\b`, 'gi');
        result = result.replace(regex, replacements[placeholder]);
    });

    // Replace {placeholder} format (alternative format)
    Object.keys(replacements).forEach(placeholder => {
        const regex = new RegExp(`{${placeholder}}`, 'gi');
        result = result.replace(regex, replacements[placeholder]);
    });

    return result;
};

/**
 * Alias for __() function
 * Similar to Laravel's trans() helper
 */
export const trans = __;

/**
 * Get translation for a choice/pluralization key
 * Similar to Laravel's trans_choice()
 *
 * @param {string} key - Translation key
 * @param {number} count - Count for pluralization
 * @param {Object} replacements - Replacement values
 * @returns {string} Translated and pluralized string
 *
 * @example
 * trans_choice('There is one apple|There are many apples', 1) // "There is one apple"
 * trans_choice('There is one apple|There are many apples', 5) // "There are many apples"
 */
export const trans_choice = (key, count, replacements = {}) => {
    let translation = __(key, { ...replacements, count });

    // If translation contains pipe character, handle pluralization
    if (translation.includes('|')) {
        const parts = translation.split('|');

        // Simple pluralization: singular|plural
        if (parts.length === 2) {
            translation = count === 1 ? parts[0] : parts[1];
        }
    }

    // Replace :count placeholder
    translation = translation.replace(/:count\b/gi, count);

    return translation;
};

/**
 * Check if a translation key exists
 *
 * @param {string} key - Translation key
 * @returns {boolean} True if translation exists
 */
export const hasTranslation = (key) => {
    const translations = getTranslations();
    return !!translations[key];
};

/**
 * Get current locale from window object
 *
 * @returns {string} Current locale code (e.g., 'en', 'es')
 */
export const getLocale = () => {
    return window.locale || document.documentElement.lang || 'en';
};

/**
 * Set locale (updates window.locale)
 *
 * @param {string} locale - Locale code
 */
export const setLocale = (locale) => {
    window.locale = locale;
};

export default __;

