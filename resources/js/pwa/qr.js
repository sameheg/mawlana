import QRCode from 'qrcode';

/**
 * Generate a QR code URL for a specific table and branch.
 * @param {string|number} tableId
 * @param {string|number} branchId
 * @returns {Promise<string>} Data URL representing the QR code image.
 */
export function generateMenuQR(tableId, branchId) {
    const target = `/orders?table=${encodeURIComponent(tableId)}&branch=${encodeURIComponent(branchId)}`;
    return QRCode.toDataURL(target);
}
