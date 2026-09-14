import http from 'http';

http.get('http://127.0.0.1:9222/json', (res) => {
    let raw = '';
    res.on('data', c => raw += c);
    res.on('end', () => {
        const list = JSON.parse(raw);
        const page = list.find(p => p.url.includes('demo/luxury-01'));
        if (!page) return;
        const ws = new WebSocket(page.webSocketDebuggerUrl);
        ws.onopen = () => {
            const expr = `
                (() => {
                    const el49 = document.querySelector('.elementor-element-49f92c84');
                    const el100 = document.querySelector('.elementor-element-100e95a');
                    const bb53 = document.querySelector('.elementor-element-bb53199');
                    return JSON.stringify({
                        el49Rect: el49?.getBoundingClientRect(),
                        el100Rect: el100?.getBoundingClientRect(),
                        bb53Rect: bb53?.getBoundingClientRect()
                    }, null, 2);
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
            console.log(data.result.result.value);
            ws.close();
        };
    });
});
