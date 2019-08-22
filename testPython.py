class A:
	a = 11
	def __init__(self, a):
		self.a = a
a = A(4)
print(a.a, A.a, a.a is A.a, a.a == A.a)
