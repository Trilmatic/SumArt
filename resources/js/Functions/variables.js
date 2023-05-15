export const toLocaleStringArray = [
    { code: 'ar-SA', name: 'Arabic (Saudi Arabia)' },
    { code: 'bn-BD', name: 'Bangla (Bangladesh)' },
    { code: 'bn-IN', name: 'Bangla (India)' },
    { code: 'cs-CZ', name: 'Czech (Czech Republic)' },
    { code: 'da-DK', name: 'Danish (Denmark)' },
    { code: 'de-AT', name: 'Austrian German' },
    { code: 'de-CH', name: '"Swiss" German' },
    { code: 'de-DE', name: 'Standard German (as spoken in Germany)' },
    { code: 'el-GR', name: 'Modern Greek' },
    { code: 'en-AU', name: 'Australian English' },
    { code: 'en-CA', name: 'Canadian English' },
    { code: 'en-GB', name: 'British English' },
    { code: 'en-IE', name: 'Irish English' },
    { code: 'en-IN', name: 'Indian English' },
    { code: 'en-NZ', name: 'New Zealand English' },
    { code: 'en-US', name: 'US English' },
    { code: 'en-ZA', name: 'English (South Africa)' },
    { code: 'es-AR', name: 'Argentine Spanish' },
    { code: 'es-CL', name: 'Chilean Spanish' },
    { code: 'es-CO', name: 'Colombian Spanish' },
    { code: 'es-ES', name: 'Castilian Spanish (as spoken in Central-Northern Spain)' },
    { code: 'es-MX', name: 'Mexican Spanish' },
    { code: 'es-US', name: 'American Spanish' },
    { code: 'fi-FI', name: 'Finnish (Finland)' },
    { code: 'fr-BE', name: 'Belgian French' },
    { code: 'fr-CA', name: 'Canadian French' },
    { code: 'fr-CH', name: '"Swiss" French' },
    { code: 'fr-FR', name: 'Standard French (especially in France)' },
    { code: 'he-IL', name: 'Hebrew (Israel)' },
    { code: 'hi-IN', name: 'Hindi (India)' },
    { code: 'hu-HU', name: 'Hungarian (Hungary)' },
    { code: 'id-ID', name: 'Indonesian (Indonesia)' },
    { code: 'it-CH', name: '"Swiss" Italian' },
    { code: 'it-IT', name: 'Standard Italian (as spoken in Italy)' },
    { code: 'ja-JP', name: 'Japanese (Japan)' },
    { code: 'ko-KR', name: 'Korean (Republic of Korea)' },
    { code: 'nl-BE', name: 'Belgian Dutch' },
    { code: 'nl-NL', name: 'Standard Dutch (as spoken in The Netherlands)' },
    { code: 'no-NO', name: 'Norwegian (Norway)' },
    { code: 'pl-PL', name: 'Polish (Poland)' },
    { code: 'pt-BR', name: 'Brazilian Portuguese' },
    { code: 'pt-PT', name: 'European Portuguese (as written and spoken in Portugal)' },
    { code: 'ro-RO', name: 'Romanian (Romania)' },
    { code: 'ru-RU', name: 'Russian (Russian Federation)' },
    { code: 'sk-SK', name: 'Slovak (Slovakia)' },
    { code: 'sv-SE', name: 'Swedish (Sweden)' },
    { code: 'ta-IN', name: 'Indian Tamil' },
    { code: 'ta-LK', name: 'Sri Lankan Tamil' },
    { code: 'th-TH', name: 'Thai (Thailand)' },
    { code: 'tr-TR', name: 'Turkish (Turkey)' },
    { code: 'zh-CN', name: 'Mainland China, simplified characters' },
    { code: 'zh-HK', name: 'Hong Kong, traditional characters' },
    { code: 'zh-TW', name: 'Taiwan, traditional characters' }
];

export const lookForList = [
    { name: "Article", value: "article" }
];

export const actionsList = [
    { name: "Summarize", value: "summarize" },
    { name: "Recap", value: "recap" },
    { name: "Simplify", value: "simplify" },
    { name: "Explain Like I’m Five", value: "explain like I’m five" },
    { name: "Summarize as Emoji", value: "summaraze as emoji" },
    { name: "Summarize as Poem", value: "summarize as poem" },
    { name: "Summarize for Gen Z", value: "summarize for Gen Z" }
];

export const automationTypes = [
    { name: "RSS source summary", value: "rss-source-summary" }
];

export const automationFrequencies = [
    { name: "daily", value: "daily" },
    { name: "hourly", value: "hourly" },
    { name: "every 15 minutes", value: "every 15 minutes" }
];

export const alertMessages = {
    "source:validated": {
        type: "success",
        message: "RSS source validated.",
    },
    "source:error": {
        type: "error",
        message: "Not a valid RSS source.",
    }
};