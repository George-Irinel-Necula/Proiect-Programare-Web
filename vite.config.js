import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import liveReload from 'vite-plugin-live-reload'

export default defineConfig({
  plugins: [
    tailwindcss(),
    liveReload('**/*.php')
  ],
  server: {
    port: 5173,
    strictPort: true,
    cors: true,
    proxy: {
      '/Proiect-ECom': {
        target: 'http://localhost',
        changeOrigin: true,
      }
    }
  },
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: './src/main.js',
    },
  },
})