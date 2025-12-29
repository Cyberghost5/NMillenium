import 'package:flutter/material.dart';

const primaryColors = MaterialColor(
  0xFF30475E, // primaryColor
  <int, Color>{
    50: primaryColor,
    100: primaryColor,
    200: primaryColor,
    300: primaryColor,
    400: primaryColor,
    500: primaryColor,
    600: primaryColor,
    700: primaryColor,
    800: primaryColor,
    900: primaryColor,
  },
);

const primaryColor = Color(0xFF30475E);
const backgroundColorLightTheme = Color(0xFFF5F5F5);
const backgroundColorDarkTheme = Color(0xFF1F4F6A);
const accentColor = Color(0xFF3CB8EA);
const splashBackColor1 = Color(0xFF2F5F7A);
const splashBackColor2 = Color(0xFF9EDAF3);
const whiteColor = Color(0xFFFFFFFF);
const blackColor = Color(0xFF000000);

const onboardingButtonColor1 = Color(0xFF3E2F7A);
const onboardingButtonColor2 = Color(0xFF9EDAF3);
const onboardingBGColor = Color(0xFFFFFFFF);

const indicatorColor1 = Color(0xFF8FB3FF);
const indicatorColor2 = Color(0xFFAEE3F6);
const indicatorColor3 = Color(0xFFF6B394);

const indicatorColor = LinearGradient(
  colors: [
    onboardingButtonColor1,
    onboardingButtonColor2,
  ],
);
