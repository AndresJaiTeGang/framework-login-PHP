import { defineConfig } from 'vite'
import { resolve } from 'path'

export default defineConfig({
  build: {
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'index.html'),
        help: resolve(__dirname, 'src/pages/help.html'),
        recover: resolve(__dirname, 'src/pages/recover.html')
      }
    }
  }
})
