__author__ = 'kevin'

import argparse
from suds.client import Client


def main():
    args = parse_args()

    url = 'http://simon.ist.rit.edu:8080/beer/BeerService?wsdl'
    client = Client(url)

    methods = {
        'getMethods': client.service.getMethods,
        'getPrice': client.service.getPrice,
        'getBeers': client.service.getBeers,
        'getCheapest': client.service.getCheapest,
        'getCostliest': client.service.getCostliest,
    }

    result = ''

    if args.method == 'getPrice':
        if args.beer:
            result = methods[args.method](args.beer)
        else:
            print("If calling getPrice. A beer name needs to be supplied as an argument through the -b option.")
            exit()
    else:
        result = methods[args.method]()

    # print("RESULT")
    # print("======")
    print(result)


def parse_args():
    """
        Provides a command line interface.

        Defines all the positional and optional arguments along with their respective valid values
        for the command line interface and returns all the received arguments as an object.

        Returns:
            An object that contains all the provided command line arguments.
    """
    parser = argparse.ArgumentParser(
        description="Invokes the various methods of the Beer Web Service at simon. "
                    "Available methods: getMethods, getPrice, getBeers, getCheapest, getCostliest.")

    parser.add_argument("method",
                        help="The name of the method to call in the Beer Web Service.")

    parser.add_argument("-b", "--beer",
                        help="If calling getPrice, this is the name of the Beer to get the price for.")

    return parser.parse_args()

if __name__ == '__main__':
    main()