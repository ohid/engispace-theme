# 🚀 Deployment Guide - Engispace Theme

## Overview

This repository is configured with automated deployment for deploying the WordPress theme to Hostinger hosting via FTP.

## 📂 Workflow Files

- **`.github/workflows/deploy-production.yml`** - Deploys to production (main branch)
- **`.github/dependabot.yml`** - Automated dependency updates

## 🔑 Required GitHub Secrets

### Production Environment
Navigate to **Settings > Secrets and variables > Actions** and add these secrets:

```
FTP_HOST=your-hostinger-ftp-host
FTP_USERNAME=your-ftp-username
FTP_PASSWORD=your-ftp-password
FTP_PORT=21
```

### Optional SSH Secrets (for verification)
```
SSH_USERNAME=your-ssh-username
SSH_PASSWORD=your-ssh-password
SSH_PORT=22
```


### Notifications (Optional)
```
SLACK_WEBHOOK_URL=your-slack-webhook-url
```

## 🌿 Branch Strategy

### `main` branch
- **Triggers**: Production deployment
- **Target**: `public_html/wp-content/themes/engispace-theme/`
- **Manual approval**: Required via GitHub environment protection

## 🚀 Deployment Process

### Automatic Deployment
1. **Push to `main`** → Triggers production deployment

### Manual Deployment
1. Go to **Actions** tab in GitHub
2. Select **Deploy to Production**
3. Click **Run workflow**
4. Choose branch and options

## 📋 What Gets Deployed

### ✅ Included Files
- All PHP theme files
- Compiled CSS files (`assets/css/`)
- Minified JavaScript files (`assets/js/dist/`)
- Images and assets (`assets/img/`)
- Composer vendor folder (for autoloading)
- Template files and parts

### ❌ Excluded Files
- Source SCSS files (`assets/scss/`)
- `node_modules/`
- Build tools (`gruntfile.js`, `package.json`)
- Git files (`.git/`, `.gitignore`)
- Development configs (`tailwind.config.js`)
- Build artifacts (`build/`)

## 🔧 Build Process

The deployment includes these build steps:
1. **Install dependencies** (npm + composer)
2. **Compile SCSS** → CSS
3. **Minify CSS** files
4. **Minify JavaScript** files
5. **Create theme zip** package
6. **Extract and deploy** to server

## 🛡️ Environment Protection

### Production Environment
- **Required reviewers**: Set up in repository settings
- **Deployment branches**: Only `main`
- **Manual approval**: Required before deployment

### Setting up Environment Protection
1. Go to **Settings > Environments**
2. Create **production** environment
3. Add protection rules:
   - Required reviewers
   - Deployment branches: `main`
   - Environment secrets

## 📊 Monitoring

### Deployment Status
- Check **Actions** tab for deployment status
- Review logs for any issues
- Slack notifications (if configured)

### Rollback Process
1. **Revert commit** on main branch, OR
2. **Restore from backup** via FTP, OR  
3. **Deploy previous version** manually

## 🐛 Troubleshooting

### Common Issues

#### FTP Connection Failed
- Verify FTP credentials in GitHub secrets
- Check Hostinger FTP settings
- Ensure correct port (usually 21 or 22)

#### Build Failed
- Check Node.js/PHP versions in workflow
- Verify all dependencies are in package.json/composer.json
- Review build logs in Actions tab

#### Permission Errors
- Ensure FTP user has write permissions
- Check file permissions on server
- Verify correct server directory path

#### Missing Files After Deployment
- Check exclude patterns in workflow
- Verify build process completed successfully
- Ensure all required files are in repository

### Debug Steps
1. **Check Action logs** - View detailed error messages
2. **Verify secrets** - Ensure all required secrets are set
3. **Test FTP manually** - Use FTP client to verify connection
4. **Check file permissions** - Ensure correct ownership/permissions

## 📞 Support

For deployment issues:
1. Check the **Actions** tab for detailed logs
2. Review this documentation
3. Contact the development team

## 🔄 Updating This Setup

To modify the deployment:
1. Edit workflow files in `.github/workflows/`
2. Update secrets in repository settings
3. Test changes on staging first
4. Document any changes in this file

---

**Last Updated**: $(date +%Y-%m-%d)
**Version**: 1.0.0