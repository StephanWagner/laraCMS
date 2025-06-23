import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const themes = ['laracms'];

const input = {
  'admin/js/app': 'resources/admin/js/app.js',
  'admin/css/main': 'resources/admin/scss/main.scss',
};

themes.forEach((theme) => {
  input[`themes/${theme}/js/app`] = `resources/themes/${theme}/js/app.js`;
  input[`themes/${theme}/css/main`] = `resources/themes/${theme}/scss/main.scss`;
});

export default defineConfig({
  plugins: [
    laravel({
      input,
      buildDirectory: '.',
      refresh: false,
    }),
  ],
  build: {
    manifest: false,
    emptyOutDir: false,
    rollupOptions: {
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name].css',
        chunkFileNames: 'chunks/[name].js',
      },
    },
  },
});
