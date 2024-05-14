<?php 

interface AbstractFactory
{
    public function createProductA(): AbstractProductA;
    public function createProductB(): AbstractProductB;
}

interface AbstractProductA
{
    public function usefulFunctionA(): string;
}


interface AbstractProductB
{
    public function usefulFunctionB(): string;

    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string;
}


class ConcreteFactory1 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA1();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB1();
    }
}

class ConcreteFactory2 implements AbstractFactory
{
    public function createProductA(): AbstractProductA
    {
        return new ConcreteProductA2();
    }

    public function createProductB(): AbstractProductB
    {
        return new ConcreteProductB2();
    }
}



class ConcreteProductA1 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "The result of the product A1";
    }
}

class ConcreteProductA2 implements AbstractProductA
{
    public function usefulFunctionA(): string
    {
        return "the result of the product A2";
    }
}



class ConcreteProductB1 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "The result of the product B1";
    }

    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();
        return "The Result of the B1 collaboration with the ({$result})";
    }
}

class ConcreteProductB2 implements AbstractProductB
{
    public function usefulFunctionB(): string
    {
        return "The result of the product B2";
    }

    public function anotherUsefulFunctionB(AbstractProductA $collaborator): string
    {
        $result = $collaborator->usefulFunctionA();
        return "The result of the B2 collaborating with me ({$result})";
    }
}


function clientCode(AbstractFactory $factory)
{
    $productA = $factory->createProductA();
    $productB = $factory->createProductB();

    echo $productB->usefulFunctionB() . "<br><br>";
    echo $productB->anotherUsefulFunctionB($productA) . "<br><br>";
}

echo "Client: Testing client code with the first factory type: <br><br>";
clientCode(new ConcreteFactory1());

echo "<br><br>";

echo "Client: Testing the same client code with the seconde factory type: <br><br>";
clientCode(new ConcreteFactory2());

