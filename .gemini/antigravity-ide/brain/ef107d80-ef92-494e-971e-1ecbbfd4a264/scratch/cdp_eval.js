import http from 'http';

http.get('http://127.0.0.1:9222/json', (res) => {
    let raw = '';
    res.on('data', chunk => raw += chunk);
    res.on('end', () => {
        const list = JSON.parse(raw);
        const page = list.find(p => p.type === 'page' && p.url.includes('demo/luxury'));
        if (!page) {
            console.log('No luxury page found. Pages:', list.map(p => p.url));
            return;
        }
        console.log('Connecting to:', page.title, page.url);
        const ws = new WebSocket(page.webSocketDebuggerUrl);
        ws.onopen = () => {
            const expr = `
                (() => {
                    const e47 = document.querySelector('.elementor-element-e47b0ce');
                    const e84 = document.querySelector('.elementor-element-848e89d');
                    const el52 = document.querySelector('.elementor-element-52f6b538');
                    const topEl = document.elementFromPoint(150, 150);
                    
                    return JSON.stringify({
                        pointAt150x150: topEl ? { tag: topEl.tagName, class: topEl.className, bg: getComputedStyle(topEl).backgroundColor } : null,
                        e47: e47 ? {
                            display: getComputedStyle(e47).display,
                            position: getComputedStyle(e47).position,
                            zIndex: getComputedStyle(e47).zIndex,
                            rect: e47.getBoundingClientRect()
                        } : null,
                        e84: e84 ? {
                            display: getComputedStyle(e84).display,
                            width: getComputedStyle(e84).width,
                            height: getComputedStyle(e84).height,
                            rect: e84.getBoundingClientRect()
                        } : null,
                        el52: el52 ? {
                            display: getComputedStyle(el52).display,
                            width: getComputedStyle(el52).width,
                            height: getComputedStyle(el52).height,
                            bg: getComputedStyle(el52).backgroundColor,
                            rect: el52.getBoundingClientRect()
                        } : null
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
