const fs = require('fs');
const content = fs.readFileSync('resources/views/admin/dashboard.blade.php', 'utf8');
content.split('\n').forEach((line, index) => {
  if (line.includes('solicitacoes')) {
    console.log(`${index + 1}: ${line.trim()}`);
  }
});
