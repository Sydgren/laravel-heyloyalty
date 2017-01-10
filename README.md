# HeyLoyalty Laravel Helper
[![Build](https://travis-ci.org/Sydgren/heyloyalty.svg?branch=develop)](https://travis-ci.org/Sydgren/heyloyalty)

Sydgren\HeyLoyalty is a package for Laravel 5.X that allows easy management of a HeyLoyalty member list.

### Features
* Subscribe
* Unsubscribe
* Update HeyLoyalty with latest data from Eloquent model
* Update custom fields
* Check subscription status

## Installation
In your `config/app.php` file, add this line to your list of service providers:

```
Sydgren\HeyLoyalty\HeyLoyaltyProvider::class,
```

In the same file, add this line to your list of facades:

```
'HeyLoyalty' => Sydgren\HeyLoyalty\Facades\HeyLoyalty::class
```

Finally, to get the config file, run this artisan command:

```
php artisan vendor:publish --provider="Sydgren\HeyLoyalty\HeyLoyaltyServiceProvider" --tag="config"
```

## Configuration
The default config file looks like this:

```
TODO
```

...

## Usage
This package includes a trait (`SubscribesToHeyLoyalty`) to apply to your User model.

Apply this trait to by adding the following line at the top of the class:

```
class User extends Model
{
    use Sydgren\HeyLoyalty\Traits\SubscribesToHeyLoyalty;
    
    ...
}
```

This trait will add functionality to subscribe, unsubscribe and update the associated member in HeyLoyalty.

## Examples

#### Subscribing
Let's say you run a webshop, and your customer went through the checkout flow and accepted receiving newsletters.

On the receipt page, you could do this in the controller:

```
public function receipt(Request $request, Order $order)
{
    ...
    
    if ($order->subscribe_to_newsletter) {
        $order->user->subscribe();
    }
    
    ...
}
```

#### Updating
I recommend using Model Observers like so:

```
class UserObserver
{
    ...
    
    public function updating(User $user)
    {
        $user->updateHL();
    }
}
```

And in  your `AppServiceProvider`:

```
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::observe(new UserObserver);
    }
    
    ...
}
```

## Contributing
Feel free to make any changes/additions.

Fork the repository and submit a pull request, then I'll take a look at your code whenever I can.
