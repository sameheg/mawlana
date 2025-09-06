const DB_NAME = 'pos-sync';
const STORE_NAME = 'changes';

export function saveChange(record) {
    const request = indexedDB.open(DB_NAME, 1);
    request.onupgradeneeded = () => {
        const db = request.result;
        db.createObjectStore(STORE_NAME, { autoIncrement: true });
    };
    request.onsuccess = () => {
        const db = request.result;
        const tx = db.transaction(STORE_NAME, 'readwrite');
        tx.objectStore(STORE_NAME).add(record);
    };
}

export function syncChanges() {
    const request = indexedDB.open(DB_NAME, 1);
    request.onsuccess = () => {
        const db = request.result;
        const tx = db.transaction(STORE_NAME, 'readwrite');
        const store = tx.objectStore(STORE_NAME);
        const getAll = store.getAll();
        getAll.onsuccess = async () => {
            const changes = getAll.result;
            if (!navigator.onLine || changes.length === 0) return;
            try {
                await fetch('/api/sync', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ changes }),
                });
                store.clear();
            } catch (e) {
                console.error('Sync failed', e);
            }
        };
    };
}

window.addEventListener('online', syncChanges);
