import fs from 'fs';
const content = fs.readFileSync('resources/views/public/home.blade.php', 'utf8');
content.split('\n').forEach((line, index) => {
  if (line.includes("customerTab === 'view_request'") || line.includes('sendChatMessage') || line.includes('chatInput')) {
    console.log(`${index + 1}: ${line.trim()}`);
  }
});
