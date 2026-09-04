<!-- HIDE ALL SCROLLBARS FOR CLEAN SMARTPHONE DISPLAY -->
<style>
    html, body {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }
    html::-webkit-scrollbar, 
    body::-webkit-scrollbar, 
    *::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }
</style>

<!-- LIVE PREVIEW SYNC LISTENER (KLIKMOMEN DEMO STUDIO) -->
<script>
    (function() {
        window.addEventListener('message', function(event) {
            if (!event.data || event.data.type !== 'KLIKMOMEN_DEMO_UPDATE') return;
            const d = event.data.payload || {};

            if (d.groomNickname !== undefined) {
                document.querySelectorAll('[data-preview="groom-nickname"]').forEach(function(el) { el.textContent = d.groomNickname; });
            }
            if (d.brideNickname !== undefined) {
                document.querySelectorAll('[data-preview="bride-nickname"]').forEach(function(el) { el.textContent = d.brideNickname; });
            }
            if (d.groomNickname !== undefined || d.brideNickname !== undefined) {
                const g = d.groomNickname !== undefined ? d.groomNickname : '';
                const b = d.brideNickname !== undefined ? d.brideNickname : '';
                document.querySelectorAll('[data-preview="couple-nickname"]').forEach(function(el) { 
                    el.textContent = g + (g && b ? ' & ' : '') + b; 
                });
            }
            if (d.groomName !== undefined) {
                document.querySelectorAll('[data-preview="groom-name"]').forEach(function(el) { el.textContent = d.groomName; });
            }
            if (d.brideName !== undefined) {
                document.querySelectorAll('[data-preview="bride-name"]').forEach(function(el) { el.textContent = d.brideName; });
            }
            if (d.guestName !== undefined) {
                document.querySelectorAll('[data-preview="guest-name"]').forEach(function(el) { el.textContent = d.guestName; });
            }
            if (d.eventDate !== undefined) {
                document.querySelectorAll('[data-preview="event-date"]').forEach(function(el) { el.textContent = d.eventDate; });
            }
            if (d.venueName !== undefined) {
                document.querySelectorAll('[data-preview="venue-name"]').forEach(function(el) { el.textContent = d.venueName; });
            }

            // DYNAMIC STORIES SYNC (SUPPORTS ADDING, DELETING & LIVE TYPING)
            if (Array.isArray(d.stories)) {
                const container = document.querySelector('[data-preview-container="stories"]');
                if (container) {
                    // Remember first card as template if not stored yet
                    if (!container._cardTemplate && container.children.length > 0) {
                        container._cardTemplate = container.children[0].cloneNode(true);
                    }

                    // Dynamically append extra cards if user added new stories
                    while (container.children.length < d.stories.length && container._cardTemplate) {
                        const newCard = container._cardTemplate.cloneNode(true);
                        container.appendChild(newCard);
                    }

                    // Dynamically remove extra cards if user removed stories
                    while (container.children.length > d.stories.length && container.children.length > 0) {
                        container.removeChild(container.lastElementChild);
                    }

                    // Update every card with the latest data
                    Array.from(container.children).forEach(function(card, idx) {
                        const story = d.stories[idx] || {};
                        const num = idx + 1;

                        const yearEl = card.querySelector('[data-preview^="story-year"]') || card.querySelector('span');
                        if (yearEl) {
                            yearEl.setAttribute('data-preview', 'story-year-' + num);
                            yearEl.textContent = story.year || '';
                        }

                        const titleEl = card.querySelector('[data-preview^="story-title"]') || card.querySelector('h3, h4, h5');
                        if (titleEl) {
                            titleEl.setAttribute('data-preview', 'story-title-' + num);
                            titleEl.textContent = story.title || '';
                        }

                        const descEl = card.querySelector('[data-preview^="story-desc"]') || card.querySelector('p');
                        if (descEl) {
                            descEl.setAttribute('data-preview', 'story-desc-' + num);
                            descEl.textContent = story.desc || '';
                        }

                        const badgeEl = card.querySelector('[data-preview^="story-badge"]');
                        if (badgeEl) {
                            badgeEl.setAttribute('data-preview', 'story-badge-' + num);
                            badgeEl.textContent = (num < 10 ? '0' : '') + num;
                        }

                        const imgEl = card.querySelector('img');
                        if (imgEl && story.title) {
                            imgEl.alt = story.title;
                        }
                    });
                }
            }
        });

        if (window.parent && window.parent !== window) {
            window.parent.postMessage({ type: 'KLIKMOMEN_DEMO_READY' }, '*');
        }
    })();
</script>
