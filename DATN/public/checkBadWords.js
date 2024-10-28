// checkBadWords.js
const { badWords } = require('vn-badwords');

// Lấy văn bản từ đối số dòng lệnh
const text = process.argv[2];

// Kiểm tra từ ngữ không phù hợp
const result = badWords(text, { validate: true });

// In ra true hoặc false
console.log(result);
