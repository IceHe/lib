console.log(Buffer.isEncoding('base64url'));

const s = '\u00E9';
console.log('s=[' + s + ']');

// Type BufferEncoding = 'ascii' | 'utf8' | 'utf-8' | 'utf16le' | 'ucs2' | 'ucs-2' | 'base64' | 'base64url' | 'latin1' | 'binary' | 'hex';

// const sAscii = Buffer.from(s, 'ascii').toString();
// const sUtf8 = Buffer.from(s, 'utf-8').toString();
// const sUtf16le = Buffer.from(s, 'utf16le').toString();
// const sUcs2 = Buffer.from(s, 'ucs-2').toString();
// const sBase64 = Buffer.from(s, 'base64').toString();
// const sBase64url = Buffer.from(s, 'base64url').toString();
// const sLatin1 = Buffer.from(s, 'latin1').toString();
// const sBinary = Buffer.from(s, 'binary').toString();
// const sHex = Buffer.from(s, 'hex').toString();

const sAscii = Buffer.from(s).toString('ascii');
const sUtf8 = Buffer.from(s).toString('utf-8');
const sUtf16le = Buffer.from(s).toString('utf16le');
const sUcs2 = Buffer.from(s).toString('ucs-2');
const sBase64 = Buffer.from(s).toString('base64');
const sBase64url = Buffer.from(s).toString('base64url');
const sLatin1 = Buffer.from(s).toString('latin1');
const sBinary = Buffer.from(s).toString('binary');
const sHex = Buffer.from(s).toString('hex');

// Console.log('sAscii=[' + sAscii + ']');
// console.log('sUtf8=[' + sUtf8 + ']');
// console.log('sUtf16le=[' + sUtf16le + ']');
// console.log('sUcs2=[' + sUcs2 + ']');
// console.log('sBase64=[' + sBase64 + ']');
// console.log('sBase64url=[' + sBase64url + ']');
// console.log('sLatin1=[' + sLatin1 + ']');
// console.log('sBinary=[' + sBinary + ']');
// console.log('sHex=[' + sHex + ']');

// console.log('sAscii=[' + sAscii + ']');
// console.log('sUtf8=[' + sUtf8 + ']');
// console.log('sUtf16le=[' + sUtf16le + ']');
// console.log('sUcs2=[' + sUcs2 + ']');
// console.log('sBase64=[' + sBase64 + ']');
// console.log('sBase64url=[' + sBase64url + ']');
// console.log('sLatin1=[' + sLatin1 + ']');
// console.log('sBinary=[' + Buffer.from(sBinary, 'binary').toString('utf-8') + ']');
// console.log('sHex=[' + sHex + ']');

console.log('sBinary=[' + Buffer.from(sBinary, 'binary').toString('base64') + ']');
console.log('sBinary=[' + btoa(sBinary) + ']');

console.log('sUtf8=[' + btoa(sUtf8) + ']');
