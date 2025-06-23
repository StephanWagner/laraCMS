import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig(({ mode }) => {
  const isDev = mode === 'development';

  return {
    build: {
      outDir: 'public',
      emptyOutDir: false,
      manifest: false,
      minify: !isDev, // 👈 Minify only in production
      sourcemap: isDev, // 👈 Sourcemaps only in dev
      rollupOptions: {
        input: {
          'admin-assets/js/app': 'resources/admin/js/app.js',
          'admin-assets/css/main': 'resources/admin/scss/main.scss',
          'themes/laracms/js/app': 'resources/themes/laracms/js/app.js',
          'themes/laracms/css/main': 'resources/themes/laracms/scss/main.scss',
        },
        output: {
          entryFileNames: '[name].js',
          assetFileNames: '[name].css',
          chunkFileNames: 'chunks/[name].js',
        },
      },
    },
  };
});
