const http = require('http');

const html = `<!DOCTYPE html>
<html lang="en">
<head>
  <title>IceHe's Lib</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <h1>IceHe's Lib</h1>
</body>
</html>`;

const app = new http.Server();

app.on('request', (req, res) => {
  res.writeHead(200, {
    'Content-Type': 'text/html',
  });
  res.write(html);
  res.end('\n');
});

module.exports = app;
