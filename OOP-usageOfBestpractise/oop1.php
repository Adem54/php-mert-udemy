<?php 

//1-Dogrudan tanimlayacagimz tum alanlari(property veya field) lari public tanimlayip herkese acik yapmak dogru bir yaklasim degildir ve bu bizi sinirlayan bir yaklasimdir

// Listing 1. Bad habit of exposing public fields

	class Person
	{
		public $prefix;
		public $givenName;
		public $familyName;
		public $suffix;
	}

	$person = new Person();
	$person->prefix = "Mr.";
	$person->givenName = "John";

	echo($person->prefix);
	echo($person->givenName);

	//Nesneyle ilgili herhangi bir değişiklik olursa, onu kullanan herhangi bir kodun da değişmesi gerekir. Örneğin, kişinin verilen, ailesi ve diğer adları bir KişiAdı nesnesinde kapsüllenecekse, değişikliği karşılamak için tüm kodunuzu değiştirmeniz gerekir.

	//Good habit: Use public accessors
	//İyi OO alışkanlıkları kullanılarak (Liste 2'ye bakın), aynı nesne artık genel alanlar yerine özel alanlara sahiptir ve özel alanlar, erişimciler adı verilen genel alma ve ayarlama yöntemleriyle dış dünyaya dikkatli bir şekilde maruz kalır. Bu erişimciler artık PHP sınıfınızdan bilgi almanın halka açık bir yolunu sağlıyor, böylece uygulamanızdaki bir şey değişirse, sınıfınızı kullanan tüm kodu değiştirmeniz gerekme olasılığı azalır.

	//Listing 2. Good habit of using public accessors

	class Person2
{
    private $prefix;
    private $givenName;
    private $familyName;
    private $suffix;

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setGivenName($gn)
    {
        $this->givenName = $gn;
    }

    public function getGivenName()
    {
        return $this->givenName;
    }

    public function setFamilyName($fn)
    {
        $this->familyName = $fn;
    }

    public function getFamilyName()
    {
        return $this->familyName;
    }

    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    public function getSuffix()
    {
        return $suffix;
    }

}
echo "<br>************************* <br>";
$person = new Person2();
$person->setPrefix("Mr.");
$person->setGivenName("John");

echo($person->getPrefix());
echo($person->getGivenName());

//İlk bakışta, bu çok daha fazla iş gibi görünebilir ve aslında ön uçta daha fazla iş olabilir. Bununla birlikte, tipik olarak, gelecekteki değişiklikler büyük ölçüde sağlamlaştığından, iyi OO alışkanlıklarının kullanılması uzun vadede karşılığını verir.

//Liste 3'te gösterilen kodun sürümünde, ad bölümleri için bir ilişkisel dizi kullanmak üzere dahili uygulamayı değiştirdim. İdeal olarak, daha fazla hata işlemeye sahip olurdum ve öğenin var olup olmadığını kontrol ederken daha dikkatli olurdum, ancak bu örneğin amacı, sınıfımı kullanan kodun nasıl değişmesi gerekmediğini göstermektir - mutlulukla benim sınıfımdan habersizdir. değişiklikler. OO alışkanlıklarını benimsemenin nedeninin, kodunuzun daha genişletilebilir ve sürdürülebilir olması için değişikliği dikkatli bir şekilde özetlemek olduğunu unutmayın.

//Listing 3. Another twist on this good habit with a different internal implementation

class Person3
{
    private $personName = array();

    public function setPrefix($prefix)
    {
        $this->personName['prefix'] = $prefix;
    }

    public function getPrefix()
    {
        return $this->personName['prefix'];
    }

    public function setGivenName($gn)
    {
        $this->personName['givenName'] = $gn;
    }

    public function getGivenName()
    {
        return $this->personName['givenName'];
    }

    /* etc... */
}

/*
 * Even though the internal implementation changed, the code here stays exactly
 * the same. The change has been encapsulated only to the Person class.
 */
$person = new Person3();
$person->setPrefix("Mr.");
$person->setGivenName("John");

echo($person->getPrefix());
echo($person->getGivenName());


// Bad habit: Not handling errors

//Liste 4'te gösterilen, bazı argümanları kabul eden ve bazı değerleri doldurulmuş bir Kişi nesnesi döndüren örneği ele alalım. Bununla birlikte, parsePersonName() yönteminde, sağlanan $val değişkeninin boş mu, sıfır uzunluklu bir dize mi yoksa ayrıştırılamaz biçimde bir dize mi olduğunu görmek için doğrulama yoktur. parsePersonName() yöntemi, bir Kişi nesnesi döndürmez, ancak null değerini döndürür. Bu yöntemi kullanan yöneticiler veya programcılar başlarını kaşıyabilir ve - en azından - kesme noktalarını ayarlamaya ve PHP betiğinde hata ayıklamaya başlamaları gereken bir yerde kalabilirler.

//Listing 4. Bad habit of not throwing or handling errors

class PersonUtils
{
    public static function parsePersonName($format, $val)
    {
        if (strpos(",", $val) > 0) {
            $person = new Person();
            $parts = split(",", $val); // Assume the value is last, first
            $person->setGivenName($parts[1]);
            $person->setFamilyName($parts[0]);
        }
        return $person;
    }
}

//The parsePersonName() method in Listing 4 could be modified to initialize the Person object outside the if condition, ensuring that you always get a valid Person object. However, you get a Person with no set properties, which doesn't leave you in a much better position.

//Good habit: Each module handles its own errors

// Arayanlarınızı tahminde bırakmak yerine, argümanları doğrulama konusunda proaktif olun. Ayarlanmamış bir değişken geçerli bir sonuç üretemezse, değişkeni kontrol edin ve bir InvalidArgumentException oluşturun. Dize boş olamazsa veya belirli bir biçimde olması gerekiyorsa, biçimi kontrol edin ve bir istisna atın. Liste 5, kendi istisnalarınızı nasıl oluşturacağınızı ve parsePerson() yönteminde bazı temel doğrulamaları gösteren bazı yeni koşulları gösterir.

class InvalidPersonNameFormatException extends LogicException {}

class PersonUtils
{
    public static function parsePersonName($format, $val)
    {
        if (! $format) {
            throw new InvalidPersonNameFormatException("Invalid PersonName format.");
        }

        if ((! isset($val)) || strlen($val) == 0) {
            throw new InvalidArgumentException("Must supply a non-null value to parse.");
        }

    }
}

//Sonuç olarak, insanların sınıfınızı, iç işleyişini bilmek zorunda kalmadan kullanabilmelerini istiyorsunuz. Yanlış veya sizin istemediğiniz bir şekilde kullanırlarsa, neden işe yaramadığını tahmin etmeleri gerekmez. İyi bir komşu olarak, sınıfınızı yeniden kullanan insanların psişik olmadığını anlarsınız ve bu nedenle varsayımları ortadan kaldırırsınız.

//Bad habit: Not using interfaces
//Listing 6 shows an example that loads the Person object from a database. It takes the person's name and returns the Person object in the database that matches.
//Uzak servise ten data ceken bir sistem yaparken bunlari kesinlikle interface ler uzerinden yapmak gerek yoksa bagimli oluruz

//Listing 6. Bad habit of not using interfaces

	class DBPersonProvider
	{
		public function getPerson($givenName, $familyName)
		{
			/* go to the database, get the person... */
			$person = new Person();
			$person->setPrefix("Mr.");
			$person->setGivenName("John");
			return $person;
		}
	}

	/* I need to get person data... */
	$provider = new DBPersonProvider();
	$person = $provider->getPerson("John", "Doe");

	echo($person->getPrefix());
	echo($person->getGivenName());

	//Kişiyi veritabanından yükleme kodu, ortamda bir şey değişene kadar iyidir. Örneğin, uygulamanın ilk sürümü için veritabanından Kişi yüklemek iyi olabilir, ancak ikinci sürüm için bir Web hizmetinden kişi yükleme özelliğini eklemeniz gerekebilir. Özünde, sınıf, doğrudan uygulama sınıfını kullandığı ve artık değişime karşı kırılgan olduğu için taşa döndü.

	//Burda bu islemi ilk yaparken sorun yok gibi gozukuyyor ama ortamda birseyler degistigi anda bizim sistemimiz bozulur.. Cunku dogrudan bir sinifi kullaniyor ve ona tam olarak bagimliligi var...
	
//Good habit: Use interfaces
//Liste 7, kullanıcıları yüklemenin yeni yolları kullanılabilir hale geldikçe ve uygulandıkça değişmeyen bir kod örneğini göstermektedir. Örnek, tek bir yöntem bildiren, PersonProvider adlı bir arabirimi gösterir. Herhangi bir kod bir PersonProvider kullanıyorsa, kod, uygulama sınıflarını doğrudan kullanmayı engeller. Bunun yerine, gerçek bir nesneymiş gibi PersonProvider'ı kullanır.

//Listing 7. Good habit of using interfaces

interface PersonProvider
{
    public function getPerson($givenName, $familyName);
}

class DBPersonProvider implements PersonProvider
{
    public function getPerson($givenName, $familyName)
    {
        /* pretend to go to the database, get the person... */
        $person = new Person();
        $person->setPrefix("Mr.");
        $person->setGivenName("John");
        return $person;
    }
}

class PersonProviderFactory
{
    public static function createProvider($type)
    {
        if ($type == 'database')
        {
            return new DBPersonProvider();
        } else {
            return new NullProvider();
        }
    }
}

$config = 'database';
/* I need to get person data... */
$provider = PersonProviderFactory::createProvider($config);
$person = $provider->getPerson("John", "Doe");

echo($person->getPrefix());
echo($person->getGivenName());


?>