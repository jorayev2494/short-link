export default function (request) {
    window.console.log(`Interceptor (request)  => {method: ${request.method}, url: ${request.url}}: `, request);
  
    return request
}