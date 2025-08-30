/**
 * Map file extension to file type
 */
export function fileExtensionToFileType(extension) {
  const extensionIconMap = {
    // Image
    jpg: 'image',
    jpeg: 'image',
    png: 'image',
    webp: 'image',
    svg: 'image',
    gif: 'image',
    avif: 'image',
    bmp: 'image',
    ico: 'image',

    // Image but not valid for rendering
    tiff: 'image-file',
    tif: 'image-file',
    heic: 'image-file',
    heif: 'image-file',
    tga: 'image-file',

    // Video
    mp4: 'video',
    webm: 'video',
    ogg: 'video',
    mov: 'video',
    avi: 'video',
    wmv: 'video',
    mpeg: 'video',
    mpv: 'video',
    mpg: 'video',
    m4v: 'video',
    m4p: 'video',

    // Audio
    mp3: 'audio',
    wav: 'audio',
    ogg: 'audio',
    aac: 'audio',
    m4a: 'audio',

    // Document
    pdf: 'document',
    doc: 'document',
    docx: 'document',
    xls: 'document',
    xlsx: 'document',
    csv: 'document',
    ppt: 'document',
    pptx: 'document',

    // Archive
    zip: 'archive',
    rar: 'archive',
    '7z': 'archive',
    tar: 'archive',
    gz: 'archive',
    bz2: 'archive',
    xz: 'archive',
    tsv: 'archive',

    // Code
    js: 'code',
    css: 'code',
    scss: 'code',
    sass: 'code',
    less: 'code',
    stylus: 'code',
    styl: 'code',
    ts: 'code',
    tsx: 'code',
    jsx: 'code',
    html: 'code',
    php: 'code',
    java: 'code',
    python: 'code',
    ruby: 'code',
    swift: 'code',
    kotlin: 'code',
    go: 'code',
    rust: 'code',
    scala: 'code',
    haskell: 'code',
    erlang: 'code',
    elixir: 'code',
    clojure: 'code',
    lisp: 'code',
    prolog: 'code',
    sql: 'code',
    json: 'code',
    xml: 'code',
    yaml: 'code',
    md: 'code',
    markdown: 'code',
    yml: 'code',
    sh: 'code',
    bash: 'code',
    zsh: 'code',
    fish: 'code',
    powershell: 'code',
    ps1: 'code',

    // Fonts
    ttf: 'font',
    otf: 'font',
    woff: 'font',
    woff2: 'font',
    eot: 'font',
    woff: 'font',
    woff2: 'font',
  };

  return extensionIconMap[extension] || 'file';
}

/**
 * Get file icon text
 */
export function getFileIconText(extension) {
  const fileType = fileExtensionToFileType(extension);

  const fileTypeMap = {
    image: 'image',
    'image-file': 'image',
    video: 'smart_display',
    audio: 'music_video',
    document: 'draft',
    archive: 'folder_zip',
    code: 'code_blocks',
    font: 'font_download',
    file: 'file_present',
  };

  return fileTypeMap[fileType] || fileTypeMap.file;
}

/**
 * Get file icon
 */
export function getFileIcon(extension, className = null) {
  const fileType = fileExtensionToFileType(extension);

  const classNames = ['file-icon'];
  classNames.push('-type-' + fileType);
  classNames.push('-extension-' + extension);
  if (className) {
    classNames.push(className);
  }

  const fileIconEl = document.createElement('div');
  fileIconEl.className = classNames.join(' ');
  fileIconEl.innerHTML = '<div class="icon">' + getFileIconText(extension) + '</div>';

  return fileIconEl;
}

/**
 * Get file preview
 */
export function getFilePreview({
  extension,
  filename,
  className = null,
  linkUrl = null,
  linkTarget = null,
}) {
  const fileType = fileExtensionToFileType(extension);

  const classNames = ['file-preview'];
  classNames.push('-type-' + fileType);
  classNames.push('-extension-' + extension);
  if (className) {
    classNames.push(className);
  }

  const filePreviewEl = document.createElement(linkUrl ? 'a' : 'div');
  filePreviewEl.className = classNames.join(' ');

  if (linkUrl) {
    filePreviewEl.href = linkUrl;
  }
  
  if (linkTarget) {
    filePreviewEl.target = linkTarget;
  }

  if (fileType == 'image') {
    filePreviewEl.style.backgroundImage = `url('/media/${filename}')`;
  } else {
    filePreviewEl.appendChild(getFileIcon(extension));
  }

  return filePreviewEl;
}
