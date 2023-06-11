const electron = require('electron')
const BrowserWindow = electron.BrowserWindow
const { app } = require('electron')

const path = require('path')

let mainWindow = null
const AutoLaunch = require('auto-launch')

const kazooAutoLauncher = new AutoLaunch({
  name: 'venturetelSMS',
  path: '/Applications/venturetelSMS.app',
})

kazooAutoLauncher
  .isEnabled()
  .then(function(isEnabled) {
    if (isEnabled) {
      return
    }
    kazooAutoLauncher.enable()
  })
  .catch(function(err) {
    // handle error
  })

app.on('window-all-closed', function() {
  if (process.platform !== 'darwin') {
    app.quit()
  }
})

app.on('ready', () => {
  mainWindow = new BrowserWindow({
    title: 'venturetelSMS',
    icon: path.join(__dirname + '/icon.icns'),
    width: 1700,
    height: 950,
    center: true,
    backgroundColor: '#171717',
  })

  // mainWindow.loadURL(`file://${path.join(__dirname, '../build/index.html')}`)
  mainWindow.loadURL('https://venturetel.app')
  mainWindow.maximize()
  mainWindow.on('minimize', () => {
    mainWindow.hide()
  })

  mainWindow.on('closed', () => {
    app.quit()
  })
})
