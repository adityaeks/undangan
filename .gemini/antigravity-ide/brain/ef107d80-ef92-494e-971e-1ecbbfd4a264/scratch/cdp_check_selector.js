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
                    const hasClass22504 = document.querySelector('.elementor-22504') !== null;
                    const e47Classes = e47 ? e47.className : null;
                    const el52 = document.querySelector('.elementor-element-52f6b538');
                    
                    return JSON.stringify({
                        hasClass22504,
                        e47Classes,
                        e47MatchesSelector: e47 ? e47.matches('.elementor-22504 .elementor-element.elementor-element-e47b0ce') : null,
                        pointAt150x150Parent: document.elementFromPoint(150, 150)?.parentElement?.className
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
            if (data.id === 1) {
                console.log('RESULT:');
                console.log(data.result.result.value);
                ws.close();
            }
        };
    });
});
