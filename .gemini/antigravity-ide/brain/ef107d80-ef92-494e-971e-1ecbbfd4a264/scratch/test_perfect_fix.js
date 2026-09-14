import http from 'http';
import fs from 'fs';

http.get('http://127.0.0.1:9222/json', (res) => {
    let raw = '';
    res.on('data', c => raw += c);
    res.on('end', () => {
        const list = JSON.parse(raw);
        const page = list.find(p => p.url.includes('demo/luxury-01'));
        if (!page) return;
        const ws = new WebSocket(page.webSocketDebuggerUrl);
        ws.onopen = () => {
            const css = `
                @media (min-width: 450px) {
                    /* Desktop Left Cover Fixed */
                    .elementor-element-e47b0ce {
                        position: fixed !important;
                        top: 0 !important;
                        left: 0 !important;
                        width: calc(100% - 450px) !important;
                        height: 100vh !important;
                        z-index: 1 !important;
                        display: flex !important;
                        overflow: hidden !important;
                    }
                    .elementor-element-e47b0ce > .elementor-container {
                        width: 100% !important;
                        height: 100% !important;
                        min-height: 100vh !important;
                    }
                    .elementor-element-848e89d {
                        width: 100% !important;
                        height: 100% !important;
                        background-image: url('/themes/luxury-01/uploads/jet-form-builder/695b3bdcd89a6aa8982774659196c290/2025/01/0-PEMBUKA.jpg') !important;
                        background-size: cover !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        display: flex !important;
                    }
                    .elementor-element-848e89d > .elementor-element-populated {
                        width: 100% !important;
                        display: flex !important;
                        flex-direction: column !important;
                        justify-content: center !important;
                        align-items: center !important;
                    }
                    .elementor-element-848e89d .elementor-background-overlay {
                        background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%) !important;
                        opacity: 0.75 !important;
                    }
                    .elementor-element-e47b0ce .elementor-invisible {
                        visibility: visible !important;
                        opacity: 1 !important;
                        animation: none !important;
                    }
                    .elementor-element-a932614 {
                        display: none !important;
                    }

                    /* Desktop Right Content Column */
                    .elementor-element-875d96b {
                        position: relative !important;
                        z-index: 2 !important;
                    }

                    /* Constrain Terima Kasih & Footer to 450px right column */
                    .elementor-element-bb53199,
                    .elementor-element-100e95a {
                        width: 450px !important;
                        max-width: 450px !important;
                        margin-left: calc(100% - 450px) !important;
                        margin-right: 0 !important;
                        position: relative !important;
                        z-index: 2 !important;
                        box-sizing: border-box !important;
                    }
                    .elementor-element-bb53199 .elementor-container,
                    .elementor-element-100e95a .elementor-container,
                    .elementor-element-100e95a footer,
                    .elementor-element-d28a23a {
                        width: 100% !important;
                        max-width: 450px !important;
                    }
                    .elementor-element-bb53199 {
                        background: transparent !important;
                    }
                }
            `;
            const expr = `
                (() => {
                    let s = document.getElementById('test-fix-css');
                    if (!s) {
                        s = document.createElement('style');
                        s.id = 'test-fix-css';
                        document.head.appendChild(s);
                    }
                    s.innerHTML = \`${css}\`;
                    const btn = document.querySelector('.btn_open') || document.querySelector('a[href="#opening"]') || document.querySelector('.elementor-widget-button a');
                    if (btn) btn.click();
                    setTimeout(() => {
                        window.scrollTo(0, document.body.scrollHeight);
                    }, 600);
                    return 'done';
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
                fs.writeFileSync('C:/Users/ACER/.gemini/antigravity-ide/brain/ef107d80-ef92-494e-971e-1ecbbfd4a264/perfect_footer_fix.png', Buffer.from(data.result.data, 'base64'));
                console.log('Saved perfect_footer_fix.png');
                ws.close();
            }
        };
    });
});
