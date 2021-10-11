import { Server } from 'http';

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

const app = new Server();

app.on('request', (request, response) => {
  response.writeHead(200, {
    'Content-Type': 'text/html',
  });
  response.write(html);
  response.end('\n');
});

export default app;
