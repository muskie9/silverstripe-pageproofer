# silverstripe-pageproofer

[![Build Status](https://travis-ci.org/muskie9/silverstripe-pageproofer.svg?branch=master)](https://travis-ci.org/muskie9/silverstripe-pageproofer) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/muskie9/silverstripe-pageproofer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/muskie9/silverstripe-pageproofer/?branch=master) [![codecov.io](https://codecov.io/github/muskie9/silverstripe-pageproofer/coverage.svg?branch=master)](https://codecov.io/github/muskie9/silverstripe-pageproofer?branch=master)

[![Latest Stable Version](https://poser.pugx.org/muskie9/pageproofer/v/stable)](https://packagist.org/packages/muskie9/pageproofer)
[![Total Downloads](https://poser.pugx.org/muskie9/pageproofer/downloads)](https://packagist.org/packages/muskie9/pageproofer)
[![Latest Unstable Version](https://poser.pugx.org/muskie9/pageproofer/v/unstable)](https://packagist.org/packages/muskie9/pageproofer)
[![License](https://poser.pugx.org/muskie9/pageproofer/license)](https://packagist.org/packages/muskie9/pageproofer)

Add PageProofer code snippet to websites via cms.

## Requirements

- [`"silverstripe/recipe-cms": "^1.0"`](https://packagist.org/packages/silverstripe/recipe-cms)

## Installation

**First:**

`composer require muskie9/pageproofer`

**Then:**

`http://yoursite.com/dev/build?flush=all`

## Sample Usage

Add PageProofer Codes in the Site Settings admin:

![Code Location CMS](/docs/en/images/code-location-cms.gif)

The code is automagically added to the page if the code domain matches your current domain and the code is enabled (both in Page Proofer and the cms):

![Code Location Browser](/docs/en/images/code-location-browser.gif)

## Documentation

See the [docs/en](docs/en/index.md) folder.