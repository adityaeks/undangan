import http from 'http';

http.get('http://127.0.0.1:9222/json', (res) => {
    let raw = '';
    res.on('data', chunk => raw += chunk);
    res.on('end', () => {
        const list = JSON.parse(raw);
        const page = list.find(p => p.type === 'page' && p.url.includes('demo/luxury-01'));
        const ws = new WebSocket(page.webSocketDebuggerUrl);
        ws.onopen = () => {
            const expr = `
                (() => {
                    const el = document.elementFromPoint(100, window.innerHeight - 50);
                    let curr = el;
                    const chain = [];
                    while (curr && curr !== document.documentElement) {
                        chain.push({
                            tag: curr.tagName,
                            class: curr.className,
                            bg: getComputedStyle(curr).backgroundColor,
                            width: getComputedStyle(curr).width,
                            rect: curr.getBoundingClientRect()
                        });
                        curr = curr.parentElement;
                    }
                    return JSON.stringify(chain, null, 2);
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
                console.log('BOTTOM ELEMENT CHAIN:');
                console.log(data.result.result.value);
                ws.close();
            }
        };
    });
});
