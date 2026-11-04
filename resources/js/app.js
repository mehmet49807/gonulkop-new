const select = (selector, scope = document) => scope.querySelector(selector);
const selectAll = (selector, scope = document) => [...scope.querySelectorAll(selector)];

const csrfToken = () => select('meta[name="csrf-token"]')?.content ?? '';

const openDialog = (dialog) => {
    if (!(dialog instanceof HTMLDialogElement) || dialog.open) {
        return;
    }

    if (typeof dialog.showModal === 'function') {
        dialog.showModal();
    } else {
        dialog.setAttribute('open', 'true');
    }
};

const closeDialog = (dialog) => {
    if (!(dialog instanceof HTMLDialogElement)) {
        return;
    }

    if (typeof dialog.close === 'function') {
        dialog.close();
    } else {
        dialog.removeAttribute('open');
    }
};

const openPremiumDialog = () => {
    const dialog = select('#premium-dialog, [data-premium-dialog]');

    if (dialog) {
        openDialog(dialog);
    }
};

const isJsonResponse = (response) => {
    return response.headers.get('content-type')?.includes('application/json') ?? false;
};

const readJson = async (response) => {
    if (!isJsonResponse(response)) {
        return null;
    }

    try {
        return await response.json();
    } catch {
        return null;
    }
};

const mediaUrl = (path) => {
    if (!path) {
        return null;
    }

    const value = String(path);

    if (/^(https?:|data:|blob:|\/)/i.test(value)) {
        return value;
    }

    return `/storage/${value}`;
};

document.addEventListener('click', (event) => {
    const opener = event.target.closest('[data-dialog-open]');

    if (opener) {
        const dialog = select(opener.dataset.dialogOpen);

        if (dialog) {
            openDialog(dialog);
        }
    }

    const closer = event.target.closest('[data-dialog-close]');

    if (closer) {
        closeDialog(closer.closest('dialog'));
    }

    if (event.target.closest('[data-premium-open]')) {
        event.preventDefault();
        openPremiumDialog();
    }

    if (event.target instanceof HTMLDialogElement) {
        const bounds = event.target.getBoundingClientRect();
        const clickedOutside = event.clientX < bounds.left
            || event.clientX > bounds.right
            || event.clientY < bounds.top
            || event.clientY > bounds.bottom;

        if (clickedOutside) {
            closeDialog(event.target);
        }
    }
});

document.addEventListener('submit', (event) => {
    const form = event.target;

    if (form.matches('[data-confirm]') && !window.confirm(form.dataset.confirm || 'Bu işlemi onaylıyor musunuz?')) {
        event.preventDefault();
    }
});

const initializeFilePreview = () => {
    selectAll('[data-chat-file]').forEach((input) => {
        const form = input.closest('form');
        const preview = select('[data-file-preview]', form);
        const previewImage = select('[data-file-preview-image]', form);
        const previewName = select('[data-file-preview-name]', form);
        const removeButton = select('[data-file-preview-remove]', form);
        let objectUrl = null;

        const clearPreview = (resetInput = true) => {
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }

            if (resetInput) {
                input.value = '';
            }

            preview?.classList.add('hidden');
            preview?.classList.remove('flex');

            if (previewImage) {
                previewImage.hidden = true;
                previewImage.removeAttribute('src');
            }
        };

        input.addEventListener('change', () => {
            const file = input.files?.[0];
            clearPreview(false);

            if (!file || !preview) {
                return;
            }

            if (previewName) {
                previewName.textContent = file.name;
            }

            if (file.type.startsWith('image/') && previewImage) {
                objectUrl = URL.createObjectURL(file);
                previewImage.src = objectUrl;
                previewImage.hidden = false;
            }

            preview.classList.remove('hidden');
            preview.classList.add('flex');
        });

        removeButton?.addEventListener('click', clearPreview);
    });
};

const initializeAvatarPreview = () => {
    selectAll('[data-avatar-file]').forEach((input) => {
        const form = input.closest('form');
        const current = select('[data-avatar-current]', form);
        const previewWrap = select('[data-avatar-preview-wrap]', form);
        const preview = select('[data-avatar-preview]', form);
        const removeButton = select('[data-avatar-remove]', form);
        let objectUrl = null;

        const clearPreview = (resetInput = true) => {
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }

            if (resetInput) {
                input.value = '';
            }

            current?.classList.remove('hidden');
            previewWrap?.classList.add('hidden');
            previewWrap?.classList.remove('flex');
            preview?.removeAttribute('src');
        };

        input.addEventListener('change', () => {
            const file = input.files?.[0];
            clearPreview(false);

            if (!file || !file.type.startsWith('image/') || !preview || !previewWrap) {
                return;
            }

            objectUrl = URL.createObjectURL(file);
            preview.src = objectUrl;
            current?.classList.add('hidden');
            previewWrap.classList.remove('hidden');
            previewWrap.classList.add('flex');
        });

        removeButton?.addEventListener('click', () => clearPreview());
    });
};

const initializeTextareas = () => {
    selectAll('textarea').forEach((textarea) => {
        const resize = () => {
            textarea.style.height = 'auto';
            textarea.style.height = `${Math.min(textarea.scrollHeight, 144)}px`;
        };

        textarea.addEventListener('input', resize);
        resize();
    });
};

const initializeHero3D = () => {
    const hero = select('[data-hero-3d]');

    if (!hero || !window.matchMedia('(pointer: fine)').matches) {
        return;
    }

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    if (reducedMotion.matches) {
        return;
    }

    let frameId = null;
    let targetX = 0;
    let targetY = 0;
    let currentX = 0;
    let currentY = 0;

    const render = () => {
        currentX += (targetX - currentX) * 0.08;
        currentY += (targetY - currentY) * 0.08;
        hero.style.setProperty('--tilt-x', `${currentY.toFixed(2)}deg`);
        hero.style.setProperty('--tilt-y', `${currentX.toFixed(2)}deg`);

        if (Math.abs(targetX - currentX) > 0.01 || Math.abs(targetY - currentY) > 0.01) {
            frameId = window.requestAnimationFrame(render);
        } else {
            frameId = null;
        }
    };

    const queueRender = () => {
        if (frameId === null) {
            frameId = window.requestAnimationFrame(render);
        }
    };

    hero.addEventListener('pointermove', (event) => {
        if (event.pointerType !== 'mouse') {
            return;
        }

        const bounds = hero.getBoundingClientRect();
        targetY = ((event.clientX - bounds.left) / bounds.width - 0.5) * -10;
        targetX = ((event.clientY - bounds.top) / bounds.height - 0.5) * 10;
        queueRender();
    });

    hero.addEventListener('pointerleave', () => {
        targetX = 0;
        targetY = 0;
        queueRender();
    });
};

const initializeAdminMenu = () => {
    const menu = select('#admin-mobile-menu');
    const openButton = select('[data-admin-menu-open]');

    if (!menu || !openButton) {
        return;
    }

    const closeMenu = () => {
        menu.classList.add('hidden');
        menu.setAttribute('aria-hidden', 'true');
        openButton.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
    };

    const openMenu = () => {
        menu.classList.remove('hidden');
        menu.setAttribute('aria-hidden', 'false');
        openButton.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');
        select('[data-admin-menu-close]', menu)?.focus();
    };

    openButton.addEventListener('click', openMenu);
    selectAll('[data-admin-menu-close]', menu).forEach((button) => button.addEventListener('click', closeMenu));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !menu.classList.contains('hidden')) {
            closeMenu();
            openButton.focus();
        }
    });
};

initializeFilePreview();
initializeAvatarPreview();
initializeTextareas();
initializeHero3D();
initializeAdminMenu();

window.Gonulkop = {
    closeDialog,
    openDialog,
    openPremiumDialog,
};

const createElement = (tag, className, text = null) => {
    const element = document.createElement(tag);

    if (className) {
        element.className = className;
    }

    if (text !== null) {
        element.textContent = text;
    }

    return element;
};

const createAvatar = (name, image, size = 'size-10') => {
    const avatar = createElement('span', `relative inline-flex shrink-0 ${size}`);
    const source = mediaUrl(image);

    if (source) {
        const photo = createElement('img', 'size-full rounded-full object-cover ring-2 ring-white');
        photo.src = source;
        photo.alt = name || 'Kullanıcı';
        photo.loading = 'lazy';
        photo.decoding = 'async';
        avatar.append(photo);
    } else {
        const initials = String(name || 'K')
            .trim()
            .split(/\s+/)
            .slice(0, 2)
            .map((part) => part.charAt(0).toLocaleUpperCase('tr-TR'))
            .join('');
        const initialsElement = createElement('span', `${size} grid place-items-center rounded-full bg-brand-100 text-xs font-semibold text-brand-700 ring-2 ring-white`, initials);
        initialsElement.setAttribute('aria-hidden', 'true');
        avatar.append(initialsElement);
    }

    return avatar;
};

const formatPublishedAt = (value) => {
    if (!value) {
        return '';
    }

    const date = new Date(value);

    if (Number.isNaN(date.getTime())) {
        return String(value);
    }

    const seconds = Math.round((date.getTime() - Date.now()) / 1000);
    const absoluteSeconds = Math.abs(seconds);

    if (absoluteSeconds < 60) {
        return 'az önce';
    }

    if (absoluteSeconds < 3600) {
        return `${Math.round(absoluteSeconds / 60)} dk önce`;
    }

    if (absoluteSeconds < 86400) {
        return `${Math.round(absoluteSeconds / 3600)} sa önce`;
    }

    return date.toLocaleDateString('tr-TR', { day: 'numeric', month: 'short' });
};

const createFeedPost = (post) => {
    const article = createElement('article', 'content-auto surface-card overflow-hidden');
    const user = post.user || post.author || {};
    const authorName = user.username || 'Kullanıcı';
    const authorCity = user.city || '';
    const authorImage = user.avatar_url || user.profile_photo_path || user.avatar_path || user.profile_image || user.image_path;

    const header = createElement('header', 'flex items-center justify-between gap-3 px-4 py-3.5 sm:px-5');
    const author = createElement('div', 'flex min-w-0 items-center gap-3');
    const authorText = createElement('div', 'min-w-0');
    authorText.append(createElement('h2', 'truncate text-sm font-semibold text-ink', authorName));

    const publishedAt = formatPublishedAt(post.published_at || post.publishedAt);
    if (publishedAt) {
        authorText.append(createElement('p', 'text-xs text-muted', authorCity ? `${authorCity} · ${publishedAt}` : publishedAt));
    }

    author.append(createAvatar(authorName, authorImage), authorText);
    header.append(author);

    const media = createElement('div', 'relative aspect-[4/5] overflow-hidden bg-gradient-to-br from-brand-100 via-rose-50 to-amber-100 sm:aspect-[4/3]');
    const imageSource = mediaUrl(post.image_url || post.image_path || post.image);

    if (imageSource) {
        const image = createElement('img', 'size-full object-cover');
        image.src = imageSource;
        image.alt = post.title || `${authorName} gönderisi`;
        image.loading = 'lazy';
        image.decoding = 'async';
        media.append(image);
    }

    const body = createElement('div', 'px-4 py-4 sm:px-5');
    const title = String(post.title ?? '').trim();
    const content = String(post.content ?? '').trim();

    if (title) {
        body.append(createElement('h3', 'mt-1 text-base leading-6 font-semibold text-ink', title));
    }

    if (content) {
        body.append(createElement('p', 'mt-1.5 line-clamp-3 text-sm leading-6 text-muted', content));
    }

    const likes = Number(post.likes_count ?? post.like_count ?? 0);
    if (likes > 0) {
        body.append(createElement('p', 'mt-3 text-sm font-semibold text-ink', `${new Intl.NumberFormat('tr-TR').format(likes)} beğeni`));
    }

    article.append(header, media, body);
    return article;
};

const initializeInfiniteFeed = () => {
    const feed = select('[data-feed-infinite]');

    if (!feed) {
        return;
    }

    const postsContainer = select('[data-feed-posts]', feed);
    const sentinel = select('[data-feed-sentinel]', feed);
    const status = select('[data-feed-status]', feed);
    const errorContainer = select('[data-feed-error]', feed);
    const retryButton = select('[data-feed-retry]', feed);
    const endpoint = feed.dataset.feedUrl || '/api/feed';
    let nextUrl = feed.dataset.nextUrl || '';
    let loading = false;
    let exhausted = !nextUrl;

    const normalizeFeedUrl = (value) => {
        if (!value) {
            return '';
        }

        const url = new URL(value, window.location.origin);
        const apiUrl = new URL(endpoint, window.location.origin);
        url.pathname = apiUrl.pathname;
        return url.toString();
    };

    const cursorUrl = (cursor) => {
        const url = new URL(endpoint, window.location.origin);
        url.searchParams.set('cursor', cursor);
        return url.toString();
    };

    const setStatus = (message) => {
        if (status) {
            status.textContent = message;
        }
    };

    const showError = (message) => {
        errorContainer?.classList.remove('hidden');
        setStatus(message);
    };

    const loadMore = async () => {
        if (loading || exhausted) {
            return;
        }

        loading = true;
        errorContainer?.classList.add('hidden');
        setStatus('Daha fazla gönderi yükleniyor...');

        try {
            const response = await fetch(normalizeFeedUrl(nextUrl), {
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.status === 401) {
                window.location.assign('/login');
                return;
            }

            if (response.status === 403) {
                exhausted = true;
                openPremiumDialog();
                setStatus('Akış erişimin için Premium üyeliğe geçmelisin.');
                return;
            }

            if (!response.ok) {
                throw new Error(`Feed request failed with ${response.status}`);
            }

            const payload = await response.json();
            const posts = Array.isArray(payload) ? payload : (payload.data || []);
            const fragment = document.createDocumentFragment();

            posts.forEach((post) => fragment.append(createFeedPost(post)));
            postsContainer?.append(fragment);
            select('[data-feed-empty]', feed)?.remove();

            const meta = payload.meta || {};
            nextUrl = meta.next_page_url
                ? normalizeFeedUrl(meta.next_page_url)
                : (meta.next_cursor ? cursorUrl(meta.next_cursor) : '');

            if (nextUrl) {
                setStatus('');
            } else {
                exhausted = true;
                setStatus('Akışın sonuna geldiniz.');
            }
        } catch {
            showError('Gönderiler yüklenemedi. Bağlantınızı kontrol edip tekrar deneyin.');
        } finally {
            loading = false;
        }
    };

    retryButton?.addEventListener('click', loadMore);

    if (sentinel && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            if (entries.some((entry) => entry.isIntersecting)) {
                loadMore();
            }
        }, { rootMargin: '700px 0px' });

        observer.observe(sentinel);
    } else if (nextUrl) {
        loadMore();
    }
};

initializeInfiniteFeed();

const initializeFeedFilters = () => {
    const toggle = select('[data-feed-filter-toggle]');
    const panel = select('[data-feed-filter-panel]');

    if (!toggle || !panel) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!isOpen));
        panel.classList.toggle('hidden', isOpen);
    });
};

initializeFeedFilters();

const chatNearBottom = (container) => {
    return container.scrollHeight - container.scrollTop - container.clientHeight < 120;
};

const scrollChatToBottom = (container, force = false) => {
    if (!container || (!force && !chatNearBottom(container))) {
        return;
    }

    container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
};

const createMessageElement = (message, currentUserId) => {
    const senderId = message.sender_id ?? message.sender?.id;
    const isMine = currentUserId !== null && String(senderId) === String(currentUserId);
    const article = createElement('article', `flex ${isMine ? 'justify-end' : 'justify-start'}`);
    const wrapper = createElement('div', 'max-w-[85%] sm:max-w-[72%]');
    const bubble = createElement('div', `rounded-2xl px-4 py-3 text-sm leading-6 shadow-sm ${isMine ? 'rounded-br-md bg-brand-600 text-white' : 'rounded-bl-md border border-line/70 bg-white text-ink'}`);
    const attachment = mediaUrl(message.attachment_url || message.attachment_path);

    if (attachment) {
        const link = createElement('a', 'mb-2 block overflow-hidden rounded-xl border border-line');
        const image = createElement('img', 'max-h-72 w-full object-cover');
        link.href = attachment;
        link.target = '_blank';
        link.rel = 'noopener';
        image.src = attachment;
        image.alt = 'Ek dosya';
        image.loading = 'lazy';
        link.append(image);
        bubble.append(link);
    }

    if (message.content) {
        bubble.append(createElement('p', 'whitespace-pre-wrap break-words', message.content));
    }

    wrapper.append(bubble);

    if (message.created_at) {
        const date = new Date(message.created_at);
        const time = Number.isNaN(date.getTime())
            ? message.created_at
            : date.toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' });
        wrapper.append(createElement('p', `mt-1 px-1 text-[0.6875rem] text-muted ${isMine ? 'text-right' : 'text-left'}`, time));
    }

    article.append(wrapper);

    if (message.id) {
        article.dataset.messageId = String(message.id);
    }

    return article;
};

const initializeChat = () => {
    const chat = select('[data-chat]');

    if (!chat) {
        return;
    }

    const form = select('[data-chat-form]', chat);
    const messagesContainer = select('[data-chat-messages]', chat);
    const messageList = messagesContainer?.lastElementChild;
    const currentUserId = chat.dataset.currentUserId ? chat.dataset.currentUserId : null;
    const pollUrl = chat.dataset.chatPollUrl;

    const showChatError = (message) => {
        if (!form) {
            return;
        }

        let error = select('[data-chat-error]', form);

        if (!error) {
            error = createElement('div', 'rounded-control border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-800');
            error.dataset.chatError = '';
            error.setAttribute('role', 'alert');
            form.prepend(error);
        }

        error.textContent = message;
    };

    const clearChatError = () => {
        const error = select('[data-chat-error]', form);
        error?.remove();
    };

    const appendMessage = (message, forceScroll = false) => {
        if (!message || !messageList) {
            return;
        }

        const id = message.id ? String(message.id) : null;
        const duplicate = id && selectAll('[data-message-id]', messageList).some((element) => element.dataset.messageId === id);

        if (duplicate) {
            return;
        }

        const shouldScroll = forceScroll || chatNearBottom(messagesContainer);
        messageList.append(createMessageElement(message, currentUserId));

        if (shouldScroll) {
            scrollChatToBottom(messagesContainer, forceScroll);
        }
    };

    const pollMessages = async () => {
        if (!pollUrl || document.hidden) {
            return;
        }

        try {
            const url = new URL(pollUrl, window.location.origin);
            url.searchParams.set('poll', '1');
            const response = await fetch(url, {
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.status === 403) {
                openPremiumDialog();
                return;
            }

            if (!response.ok) {
                return;
            }

            const payload = await readJson(response);

            if (!payload) {
                return;
            }

            const messages = payload.messages || (Array.isArray(payload.data) ? payload.data : []);
            messages.forEach((message) => appendMessage(message));
        } catch {
            // A transient polling failure should not interrupt the conversation.
        }
    };

    form?.addEventListener('submit', async (event) => {
        event.preventDefault();
        clearChatError();

        if (form.dataset.premiumRequired === 'true') {
            openPremiumDialog();
            return;
        }

        const submitButton = select('button[type="submit"]', form);
        const content = select('textarea[name="content"]', form)?.value.trim();

        if (!content) {
            showChatError('Mesajınızı yazın.');
            return;
        }

        submitButton?.setAttribute('disabled', 'disabled');
        submitButton?.setAttribute('aria-busy', 'true');

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken(),
                },
            });

            if (response.status === 401) {
                window.location.assign('/login');
                return;
            }

            if (response.status === 403) {
                openPremiumDialog();
                showChatError('Mesaj göndermek için Premium üyeliğe geçmelisin.');
                return;
            }

            if (response.status === 419) {
                window.location.reload();
                return;
            }

            const payload = await readJson(response);

            if (!response.ok) {
                const errors = payload?.errors ? Object.values(payload.errors).flat().join(' ') : null;
                showChatError(errors || payload?.message || 'Mesaj gönderilemedi.');
                return;
            }

            const incoming = payload?.message
                ?? (payload?.data && !Array.isArray(payload.data) ? payload.data : null)
                ?? (Array.isArray(payload?.data) ? payload.data[0] : null);

            if (incoming) {
                appendMessage(incoming, true);
            } else if (!payload) {
                window.location.reload();
                return;
            }

            form.reset();
            select('[data-file-preview-remove]', form)?.click();
            select('textarea[name="content"]', form)?.dispatchEvent(new Event('input'));
        } catch {
            showChatError('Mesaj gönderilemedi. Bağlantınızı kontrol edip tekrar deneyin.');
        } finally {
            submitButton?.removeAttribute('disabled');
            submitButton?.removeAttribute('aria-busy');
        }
    });

    if (messagesContainer) {
        requestAnimationFrame(() => scrollChatToBottom(messagesContainer, true));
    }

    if (pollUrl) {
        window.setInterval(pollMessages, 10000);
        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) {
                pollMessages();
            }
        });
    }
};

initializeChat();


