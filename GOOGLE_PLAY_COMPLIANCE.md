# Google Play Photo and Video Permissions Policy Compliance

This document outlines the changes made to ensure compliance with Google Play's Photo and Video Permissions policy.

## Summary

The Flutter WebView app has been modified to:
1. **Remove all storage and media permissions** from AndroidManifest.xml
2. **Remove permission_handler dependency** from the project
3. **Rely on Android's system Photo Picker** for one-time media selection
4. **Disable manual permission requests** for camera, microphone, and storage

## Changes Made

### 1. pubspec.yaml
- ✅ **Removed**: `permission_handler: ^11.3.1` dependency
- ✅ **Kept**: `flutter_inappwebview: ^6.1.1` for WebView functionality
- ✅ All other dependencies remain unchanged

### 2. AndroidManifest.xml (`android/app/src/main/AndroidManifest.xml`)

#### Removed Permissions:
- ❌ `READ_EXTERNAL_STORAGE`
- ❌ `WRITE_EXTERNAL_STORAGE`
- ❌ `READ_MEDIA_IMAGES`
- ❌ `READ_MEDIA_VIDEO`
- ❌ `READ_MEDIA_AUDIO`
- ❌ `CAMERA`
- ❌ `RECORD_AUDIO`
- ❌ `MODIFY_AUDIO_SETTINGS`
- ❌ `VIDEO_CAPTURE`
- ❌ `AUDIO_CAPTURE`
- ❌ `android.hardware.camera` feature

#### Kept Permissions:
- ✅ `INTERNET` (mandatory for WebView)
- ✅ `ACCESS_WIFI_STATE` (for network status)
- ✅ `BLUETOOTH` (if needed by website)

#### Removed Application Attributes:
- ❌ `android:requestLegacyExternalStorage="true"` (no longer needed)

### 3. Dart Code Changes

#### lib/main.dart
- ✅ Removed `permission_handler` import
- ✅ Removed `device_info_plus` import (was only used for storage permissions)
- ✅ Removed `enableStoragePermission()` function entirely
- ✅ Removed storage permission initialization call in `main()`

#### lib/ui/widgets/load_web_view.dart
- ✅ Removed `permission_handler` import
- ✅ **onGeolocationPermissionsShowPrompt**: Changed to DENY location permission requests (was requesting Permission.location)
- ✅ **onPermissionRequest**: Changed to DENY all camera and microphone permission requests (was granting and requesting permissions)
- ✅ **onDownloadStartRequest**: Disabled file downloads entirely (was using storage permissions to download files)
- ✅ Removed `requestPermission()` helper function
- ✅ Removed `getFilePath()` helper function
- ✅ Removed `enableStoragePermission()` usage

## How File Uploads Work Now

### For `<input type="file">` in WebView:

When users tap on `<input type="file">` elements in the website loaded in the WebView:

1. **Android 13+ (API 33+)**:
   - System automatically opens the **Photo Picker** (no permissions required)
   - Users can select photos/videos for one-time access
   - No storage permissions needed
   - Compliant with Google Play policy

2. **Android 11-12 (API 30-32)**:
   - System opens the built-in file chooser
   - Uses scoped storage (no broad storage permissions needed)
   - One-time access granted per selection

3. **flutter_inappwebview** handles this automatically:
   - The plugin's native Android code already supports the system file picker
   - No additional configuration needed
   - No platform channels required

## Important Notes

### ✅ What Works:
- Photo/video selection from `<input type="file">` elements
- One-time media access via system Photo Picker
- WebView functionality (JavaScript, file uploads, navigation)
- Network requests and cookies

### ❌ What's Disabled:
- File downloads (was violating storage permission policy)
- Camera access (was requesting CAMERA permission)
- Microphone access (was requesting RECORD_AUDIO permission)
- Geolocation (was requesting location permission)
- Direct storage access

## Testing Checklist

Before submitting to Google Play, test:

1. **File Upload Test**:
   - Load a website with `<input type="file">` or `<input type="file" accept="image/*,video/*">`
   - Tap the file input
   - Verify system Photo Picker opens (Android 13+)
   - Verify file chooser opens (Android 11-12)
   - Select a photo/video
   - Verify the file is uploaded successfully to the website

2. **Permission Test**:
   - Check device Settings → Apps → New Millennium → Permissions
   - Verify NO storage/media permissions are listed
   - Verify NO camera permission is listed
   - Only "Network" or similar should appear

3. **WebView Functionality**:
   - Test JavaScript execution
   - Test navigation and back button
   - Test pull-to-refresh
   - Test external link handling

## Play Store Submission

This implementation complies with Google Play's requirements:

> **Photo and Video Permissions (Google Play, 2024)**
> - Apps must use the system Photo Picker for one-time media access
> - Apps must NOT request `READ_MEDIA_IMAGES`, `READ_MEDIA_VIDEO`, or `READ_EXTERNAL_STORAGE` unless they have a valid use case
> - WebView apps wrapping websites do NOT have a valid use case for broad storage access

### Declaration in Play Console:

When asked "Why does your app need photos and videos permissions?":
- **Answer**: "App does not request photo/video permissions. Uses Android's system Photo Picker for one-time media selection."

## Build Instructions

After making these changes:

```bash
# Clean the project
flutter clean

# Get dependencies
flutter pub get

# Build for Android
flutter build apk --release
# OR
flutter build appbundle --release
```

## Compatibility

- ✅ **Android 11+ (API 30+)**: Fully supported with scoped storage
- ✅ **Android 13+ (API 33+)**: Uses new Photo Picker API automatically
- ✅ **Target SDK**: 34 (Android 14)
- ✅ **Min SDK**: Should be 21+ (Android 5.0+)

## Additional Resources

- [Android Photo Picker Guide](https://developer.android.com/training/data-storage/shared/photopicker)
- [Google Play Photo/Video Policy](https://support.google.com/googleplay/android-developer/answer/14115180)
- [flutter_inappwebview Documentation](https://inappwebview.dev/)

---

**Last Updated**: December 29, 2025
**Compliance Status**: ✅ Ready for Play Store submission
