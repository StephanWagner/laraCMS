import { defineConfig } from 'vite';

export default defineConfig(({ mode }) => {
  const isDev = mode === 'development';

  return {
    build: {
      outDir: 'public',
      emptyOutDir: false,
      manifest: false,
      minify: !isDev,
      sourcemap: isDev,
      rollupOptions: {
        input: {
          'admin-assets/js/app': 'resources/admin/js/app.js',
          'admin-assets/css/main': 'resources/admin/scss/main.scss',
          'themes/laracms/js/app': 'resources/themes/laracms/js/app.js',
          'themes/laracms/css/main': 'resources/themes/laracms/scss/main.scss',
        },
        output: {
          entryFileNames: isDev ? '[name].js' : '[name].min.js',
          assetFileNames: isDev ? '[name].css' : '[name].min.css',
          chunkFileNames: 'chunks/[name].js',
        },
      },
    },
  };
});
