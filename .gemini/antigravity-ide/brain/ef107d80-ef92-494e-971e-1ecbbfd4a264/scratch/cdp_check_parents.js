import http from 'http';

http.get('http://127.0.0.1:9222/json', (res) => {
    let raw = '';
    res.on('data', chunk => raw += chunk);
    res.on('end', () => {
        const list = JSON.parse(raw);
        const page = list.find(p => p.type === 'page' && p.url.includes('demo/luxury'));
        const ws = new WebSocket(page.webSocketDebuggerUrl);
        ws.onopen = () => {
            const expr = `
                (() => {
                    const e47 = document.querySelector('.elementor-element-e47b0ce');
                    let p = e47;
                    const parents = [];
                    while (p) {
                        parents.push({ tag: p.tagName, class: p.className, id: p.id });
                        p = p.parentElement;
                    }
                    return JSON.stringify(parents, null, 2);
                })()
            `;
            ws.send(JSON.stringify({
                id: 1,
                method: 'Runtime.evaluate',
                params: { expression: expr, returnByValue: true }
            }));
        };
        ws.onmessage = (msg) => {
            const data = JSON.parse(msg.data);
            if (data.id === 1) {
                console.log('PARENTS OF e47:');
                console.log(data.result.result.value);
                ws.close();
            }
        };
    });
});
