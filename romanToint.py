from posixpath import split
import string


class intRoman:
    RomanDic = {
        '1' : 'I',
        '5' : 'V',
        '10' : 'X',
        '50' : 'L',
        '100' : 'C',
        '500' : 'D',
        '1000' : 'M'
    }

    def __init__(self, intNum:int) -> None:
        self.intNum = intNum
        pass

    def intToRoman(self)->str:
        # roman = dict()
        roman = []
        intStr = str(self.intNum)
        intDic = self.split(intStr)
        intLength = len(intStr)
        place = 0
        for digit in intDic:
            roman.append(self.getRomanByDigitAndPlace(int(digit),intLength - place))
            place= place+1
        
        return ''.join(roman)

    
    def getRomanByDigitAndPlace(self, digit, place):
        output = str(digit).ljust(place,'0')
        roman = ''
        if(digit ==0):
            roman = '';
        
        elif(digit == 4):
            roman = self.RomanDic['1'.ljust(place,'0')] + self.RomanDic['5'.ljust(place,'0')]
        
        elif(digit == 9):
            roman = self.RomanDic['1'.ljust(place,'0')] + self.RomanDic['1'.ljust(place+1,'0')]

        elif(digit == 1 or digit == 5):
            roman = self.RomanDic[str(digit).ljust(place,'0')]
        else:
            if(5 - digit >0):
                roman = self.getRepeatRomanDigit(self.RomanDic['1'.ljust(place,'0')], digit)
            else:
                roman = self.RomanDic['5'.ljust(place,'0')] + self.getRepeatRomanDigit(self.RomanDic['1'.ljust(place,'0')], digit-5)

        return roman

        



    def getRepeatRomanDigit(self, roman:string, repeat:int)->string:
        str = ''
        for x in range(repeat):
            str += roman
        
        return str



    
    def split(self,word):
        return [char for char in word]






intRoman = intRoman(3219)
roman = intRoman.intToRoman() 

print(roman)