import http from 'http';
import fs from 'fs';

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
                    const btn = document.querySelector('.btn_open') || document.querySelector('a[href="#opening"]') || document.querySelector('.elementor-widget-button a');
                    if (btn) btn.click();
                    setTimeout(() => {
                        window.scrollTo(0, document.body.scrollHeight);
                    }, 500);
                    return 'clicked';
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
                setTimeout(() => {
                    ws.send(JSON.stringify({
                        id: 2,
                        method: 'Page.captureScreenshot',
                        params: { format: 'png' }
                    }));
                }, 1500);
            } else if (data.id === 2) {
                fs.writeFileSync('C:/Users/ACER/.gemini/antigravity-ide/brain/ef107d80-ef92-494e-971e-1ecbbfd4a264/test_fix_footer_opened.png', Buffer.from(data.result.data, 'base64'));
                console.log('Footer opened screenshot saved');
                ws.close();
            }
        };
    });
});
