/**
 * Map file extension to file type
 */
export function fileExtensionToFileType(extension) {
  const extensionIconMap = {
    // Image
    jpg: 'image',
    jpeg: 'image',
    png: 'image',
    gif: 'image',
    svg: 'image',
    webp: 'image',
    avif: 'image',
    heic: 'image',
    heif: 'image',
    tiff: 'image',
    tif: 'image',
    tga: 'image',
    bmp: 'image',
    ico: 'image',
    cur: 'image',

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
 * Get file icon
 */
export function getFileIcon(extension) {
    const fileType = fileExtensionToFileType(extension);
  
    const fileTypeMap = {
      image: 'image',
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
 * Get file preview
 */
export function getFilePreview(extension, className = null) {
    const fileType = fileExtensionToFileType(extension);

    const classNames = ['file-icon'];
    classNames.push('-type-' + fileType);
    classNames.push('-extension-' + extension);
    if (className) {
        classNames.push(className);
    }
    
    let html = '';
    html += '<div class="' + classNames.join(' ') + '">';
    html += '<div class="icon">' + getFileIcon(extension) + '</div>';
    html += '</div>';
  
    return html;
  }
    