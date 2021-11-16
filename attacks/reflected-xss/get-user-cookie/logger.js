const http = require('http')

const hostname = '0.0.0.0'
const port = process.env.PORT || 8000

const server = http.createServer((req, res) => {
    let body = ''
    req.on('data', chunk => body += chunk.toString())
    req.on('end', () => {
        console.log(req.socket.remoteAddress, body)
        res.end()
    })
})
  
server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`)
})

