# Authentication Factor API

> JobRouter® is a scalable digitisation platform which links processes, data and documents.


Starting with JobRouter® 5.2, a second authentication factor (2FA) can be configured in each user profile. JobRouter® 
itself already contains a 2FA plugin that sends the one-time PIN via e-mail.\
You fancy developing your own plugin that provides an authentication factor? This package contains API stubs providing
autocompletion in your IDE.


## Project status

:fire: The _Authentication Factor API_ is still in a very early alpha state. Before moving into a mature beta phase, 
that API is likely to change and custom plugins may stop working.\
We encourage everyone to experiment with it and give us feedback about it.

## Requirements

* Composer 2

## Installation

Using composer
```bash
composer require jobrouter/authentication-factor-api
```

If you are new to the JobRouter® ecosystem, you may want to have a look at an [example plugin](https://github.com/jobrouter/2fa-example-plugin) using this API.


## Licenses

All files in this repository are subject to the MIT license. Please read the [License](LICENSE) file at the root of the project.
